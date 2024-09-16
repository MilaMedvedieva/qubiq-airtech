try {
    window.jQuery = window.$ = require('jquery');
    require("slick-carousel/slick/slick.min");
    require("lazysizes/lazysizes.min");
    require("./modules/menu");
    require("./modules/slider");
    require("./modules/referenzen");
    require("./modules/category_product");
    require("./modules/produktmarke");
    require("./modules/generall");
    //require("vendors");
}
catch (e) {
    console.log('JS ERROR!!!', e);
}