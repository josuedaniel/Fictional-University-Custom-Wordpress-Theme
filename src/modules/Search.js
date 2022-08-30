import $ from 'jquery';

class Search {
    // 1. describe and create / initiate our object
    constructor() {

        // Assigns the div with the id search-overlay__results to the property this.resultsDiv
        this.resultsDiv = $("#search-overlay__results");
        // Add the classes to each event
        this.openButton = $(".js-search-trigger"); 
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        // create the property searchField and assign the div with the id search-term to it
        this.searchField = $("#search-term");
        this.events();
        //create a property that will store information about the state of the overlay
        this.isOverlayOpen = false;

        //create a property to store information about the state of the spinner
        this.isSpinnerVisible = false;

        // declares an empty property that we will assign a value to later. will be used for spinning icon
        this.previousValue;
        // declares an empty property that we will assign a value to later 
        this.typingTimer;
    }

    // 2. events
    events() {
        // adds openOverlay and closeOverlay methods to each  click event
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        // adds keyPressDispatcher method to the keyup event
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        // assigns the method typingLogic to searchField when a key is pressed
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    // 3. methods (functions, action...)
     
    //method to be performed on the div assigned to searchField
    typingLogic() {
        
        // if the value has changed. (the value won't be changed with arrow or other non typing keys)
        if (this.searchField.val() != this.previousValue) {
            
            // clear out the timer from below so that this.typingTimer does not reach 2 seconds and execute the anonymous function
            clearTimeout(this.typingTimer);

            //if the searchField val is not empty
            if (this.searchField.val()) {
                // If spinnerVisible is not true
                if (!this.isSpinnerVisible) {
                    
                    //add the div spinner-loader to this.resultsDiv
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    
                    // Sets this.isSpinnerVisible to true
                    this.isSpinnerVisible = true;
                }
                
                //sets a timeout with an anonymous function that will execute 2 seconds after the last key release
                this.typingTimer = setTimeout(this.getResults.bind(this), 2000);
            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }

            
        }
        
        //assigns the value of this.searchField to the property this.previousValue
        this.previousValue = this.searchField.val();
     }

     getResults() {
        this.resultsDiv.html("imagine real search results here");
        // Sets this.isSpinnerVisible to false
        this.isSpinnerVisible = false;
     }
    
    keyPressDispatcher(e) {
        // using e.keyCode will allow us to see the keycode for each key we press
        //console.log(e.keyCode);
        
        //Open the overlay with the method openOverlay as long as the letter s has been pressed, the overlay is 
        // not already open, and there is no input or textarea already in focus
        if (e.keyCode ==83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
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