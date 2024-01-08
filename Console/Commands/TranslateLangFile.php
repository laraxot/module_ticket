<?php

declare(strict_types=1);

namespace Modules\Ticket\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Stichoza\GoogleTranslate\GoogleTranslate;

use function Safe\json_decode;
use function Safe\json_encode;

class TranslateLangFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:lang {locales}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a JSON translation file and do the translations for you.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $locales = explode(',', $this->argument('locales'));
        foreach ($locales as $locale) {
            Artisan::call('translatable:export '.$locale);
            $filePath = lang_path($locale.'.json');
            if (File::exists($filePath)) {
                $this->info('Translating '.$locale.', please wait...');
                $results = [];
                $localeFile = File::get($filePath);
                $localeFileContent = array_keys((array) json_decode((string) $localeFile, true, 512, JSON_THROW_ON_ERROR));
                $translator = new GoogleTranslate($locale);
                $translator->setSource('en');
                foreach ($localeFileContent as $key) {
                    $results[$key] = $translator->translate((string) $key);
                }

                File::put($filePath, json_encode($results, JSON_UNESCAPED_UNICODE));
            }
        }

        return Command::SUCCESS;
    }
}
