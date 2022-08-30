import $ from 'jquery';

class Search {
    // 1. describe and create / initiate our object
    constructor() {
        // Add the classes to each event
        this.openButton = $(".js-search-trigger"); 
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.events();
        //create a property that will store information about the state of the overlay
        this.isOverlayOpen = false;
    }

    // 2. events
    events() {
        // adds openOverlay and closeOverlay methods to each  click event
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        // adds keyPressDispatcher method to the keyup event
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
    }

    // 3. methods (functions, action...)
    keyPressDispatcher(e) {
        // using e.keyCode will allow us to see the keycode for each key we press
        //console.log(e.keyCode);
        
        //assign the letter S to the method openOverlay
        if (e.keyCode ==83 && !this.isOverlayOpen) {
            this.openOverlay();
        }

        //assign the ESC button to the method closeOverlay
        if(e.keyCode ==27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }
    
    openOverlay() {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");

        // set the state of isOverlayOpen to true
        this.isOverlayOpen = true;


    }

    closeOverlay() {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        
        // set the state of isOverlayOpen to false
        this.isOverlayOpen = false;

    }
}


export default Search