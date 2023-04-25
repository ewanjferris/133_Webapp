<header>
    <div id="navbar" class="sticky-nav container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse navbar-content navbar-wrapper" id="navbarSupportedContent">
               
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="btn btn-light" id="homebutton">Home <span class="sr-only"></span></a>
                    </li>
                    <form action="destroy_session">
						<button class="btn btn-danger" type="submit" >Ausloggen</button>
					</form>            
                </ul>                     
            </div>
        </nav>
    </div>
</header>
    <style>
    header{
        position:relative;
        top:0;
        width:auto;
        z-index: 1;
        justify-content: space-between;
    }

    .navbar-wrapper{
        display: flex !important; 
        flex-direction: row;
        justify-content: space-between;
       
    }

    /*--------------------------------------------------two forms side by side and in the same line */
    .search-form{
        display: flex;  
        flex-direction: row;
         justify-content: flex-end;
    }

    .searchbar{
        height:40px;
        /* width:15vw; */
        margin-top:0px;
        margin-bottom:0px;
        /* margin-left:150%; */
        margin-right:10px;
        
    }
    
    .search-button{
        height:40px;
        
    }

/*--------------------------------------------------sticky nav*/
    .sticky-nav{
        position: sticky;
    }

    /* .content {
        padding: 16px;
    } */

    /* The sticky class is added to the navbar with JS when it reaches its scroll position */
    .sticky {
    position: fixed;
    top: 0vh;
    /* left:27vh; */
    /* width: 100vw!important; */
    display:flex;
    justify-content: center;
    
    }

    /* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
    
    
</style>



<script>
/**--------------------------------------------------------------------------------------------------------navbar start/*/
    // When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
/**--------------------------------------------------------------------------------------------------------navbar end/*/
</script>