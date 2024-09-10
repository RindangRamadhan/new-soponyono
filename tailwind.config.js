module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        bunker: '#12191C',
        west_coast: '#6D5119',
        boulder: '#7A7A7A',
      },
      fontFamily: {
        sedan: ['Sedan', 'sans-serif'], // Add Sedan as a custom font family
      },
    },
  },
  plugins: [],
};
