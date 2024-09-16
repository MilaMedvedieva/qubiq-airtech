module.exports = {
  purge: {
    mode: 'layers',
    content: ['./*.php', './inc/**/*.php', './woocommerce/**/*.php', './partials/**/*.php', './template-page/**/*.php', './template-parts/**/*.php', './assets/**/*.js'],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Ubuntu"']
      },
      container: {
        center: true,
        screens: {
          'xs': '640px',
          'sm': '768px',
          'md': '992px',
          'lg': '1024px',
          'xl': '1200px',
        }
      },
      colors: {
        current: 'currentColor',
        blue: {
          50: '#94A5B0',
          100: '#00A3C3'
        },
        green: {
          50: '#488394'
        },
        gray: {
          50: '#EDF0F2',
          100: '#E5E5E5'
        },
        black: {
          10: '#000000',
          50: '#475D63',
        }
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
