<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\RentalSource;

class ScrapeRentals extends Command
{
    protected $signature = 'app:scrape-rentals';
    protected $description = 'Scrape rental data from a fictive HTML source';

    public function handle()
    {
        $this->info('Démarrage du scraping...');
        
        // 1. Charger la source locale
        $filePath =  resource_path('sources/fake_rentals.html');

        if (!file_exists($filePath)) {
            $this->error("Fichier introuvable : $filePath");
            return;
        }

        $html = file_get_contents($filePath);

        // 2. Parser le HTML
        $crawler = new Crawler($html);

        $listings = $crawler->filter('.listing');

        if ($listings->count() === 0) {
            $this->error("Aucune annonce trouvée !");
            return;
        }

        $this->info("{$listings->count()} annonces trouvées.");
        $this->output->progressStart($listings->count());

        foreach ($listings as $listingElement) {
            $node = new Crawler($listingElement);

            $title = $node->filter('.title')->count() ? $node->filter('.title')->text() : null;
            $agency = $node->filter('.agency')->count() ? $node->filter('.agency')->text() : null;
            $phone = $node->filter('.phone')->count() ? $node->filter('.phone')->text() : null;
            $email = $node->filter('.email')->count() ? $node->filter('.email')->text() : null;
            $propertyType = $node->filter('.property-type')->count() ? $node->filter('.property-type')->text() : null;
            $city = $node->filter('.city')->count() ? $node->filter('.city')->text() : null;
            $district = $node->filter('.district')->count() ? $node->filter('.district')->text() : null;

            // Déduction AGENCY / PRIVATE
            $sourceType = str_contains(strtolower($agency), 'agence') ? 'AGENCY' : 'PRIVATE';

            // Construire une source URL fictive unique
            $sourceUrl = 'local-file://fake_rentals.html#' . md5($title.$phone);

            // Insertion avec évitement des doublons
            $existing = RentalSource::where('source_url', $sourceUrl)->first();

            if (!$existing) {
                RentalSource::create([
                    'source_url'    => $sourceUrl,
                    'source_type'   => $sourceType,
                    'name_or_title' => $title,
                    'phone_number'  => $phone,
                    'email'         => $email,
                    'property_type' => $propertyType,
                    'city'          => $city,
                    'district'      => $district,
                    'is_qualified'  => !empty($phone),
                ]);

                $this->info("→ Nouvelle annonce enregistrée : $title");
            } else {
                $this->warn("→ Doublon ignoré : $title");
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info("Scraping terminé avec succès !");
    }
}
