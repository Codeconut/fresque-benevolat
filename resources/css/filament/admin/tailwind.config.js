import preset from './tailwind.config.preset'

export default {
  presets: [preset],
  content: [
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './resources/views/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
  ],
}
