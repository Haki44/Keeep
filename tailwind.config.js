const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
    
            backgroundImage: {
                'home-page': "url('/img/home-background.png')",
                'footer-texture': "url('/img/footer-texture.png')",
            }
        },
        
    },
    
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },


};
