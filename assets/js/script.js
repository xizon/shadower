/* *************************************

	---------------------------
	MAIN SCRIPTS
	---------------------------
	
	TABLE OF CONTENTS
	---------------------------
		
	1. Header
	2. Loader
	3. scrollTop
	4. Parallax
	5. Overlay
	6. Scroll Reveal
	7. Navigation
	8. Stage Effect
	9. FlexSlider
	10. PrettyPhoto
	11. Page Transitions
	12. Grid List
	13. Forms
	14. Scroll Spy
	15. Single Page
	16. Retina Graphics for Website

************************************* */

var theme = (function ( $, window, document ) {
    'use strict';

    var theme         = {},
        components    = { documentReady: [], pageLoaded: [] };


	$( 'body' ).waitForImages( pageLoaded );
    $( document ).ready( documentReady );
	
	
	
    function documentReady( context ) {
        
        context = typeof context == typeof undefined ? $ : context;
        components.documentReady.forEach( function( component ) {
            component( context );
        });
    }

    function pageLoaded( context ){
        
        context = typeof context == "object" ? $ : context;
        components.pageLoaded.forEach( function( component ) {
           component( context );
        });
    }

    theme.setContext = function ( contextSelector ) {
        var context = $;
        if( typeof contextSelector !== typeof undefined ) {
            return function( selector ) {
                return $( contextSelector ).find( selector );
            };
        }
        return context;
    };

    theme.components         = components;
    theme.documentReady      = documentReady;
	theme.pageLoaded         = pageLoaded;

    return theme;
}( jQuery, window, document ) );



/*! 
 *************************************
 * 1. Header
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
    
    var pageLoaded = function() {
		
		headerInit();
		
		$( window ).resize( function() {
			headerInit();

		});
		
		function headerInit() {
			$( '.header-inner.auto-height' ).css( 'height', $( '.header-area' ).outerHeight() + 'px' ); 
		}
		
    };

    theme.header = {
        pageLoaded : pageLoaded        
    };

    theme.components.pageLoaded.push( pageLoaded );
    return theme;

}( theme, jQuery, window, document ) );



/*! 
 *************************************
 * 2. Loader
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
    
    var pageLoaded = function() {
		
		// Remove loader
		if ( $.browser.msie && $.browser.version < 10 ) {
			$( '.loader' ).delay( 1500 ).fadeOut();
		}
		
    };

    theme.loader = {
        pageLoaded : pageLoaded        
    };

    theme.components.pageLoaded.push( pageLoaded );
    return theme;

}( theme, jQuery, window, document ) );




/*! 
 *************************************
 * 3. scrollTop
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
    
    var documentReady = function( $ ) {
        
		// Back to top
		$( document ).UItoTop( { easingType: 'easeOutQuart', scrollSpeed: 500 } );
		
		
    };

    theme.scrolltop = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );

/*! 
 *************************************
 * 4. Parallax
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
    
    var documentReady = function( $ ) {
        
        var $window      = $( window ),
		    windowWidth  = $window.width(),
		    windowHeight = $window.height();

        

		//  Initialize
		$( '.parallax' ).each(function() {
			var dataAtt  = $( this ).data( 'parallax' ),
			    dataH    = $( this ).data( 'height' ),
				dataImg    = $( this ).data( 'image-src' ),
				dataSkew    = $( this ).data( 'skew' );
			
			
			if( typeof dataAtt === typeof undefined ) {
				dataAtt = 'fixed';
			}
			
			if( typeof dataH != typeof undefined ) {
				$( this ).css( {
					'height': dataH
				} );
			}
			
			
			if ( 
			    $( this ).hasClass( 'height-10' ) || 
				$( this ).hasClass( 'height-20' ) || 
				$( this ).hasClass( 'height-30' ) || 
				$( this ).hasClass( 'height-40' ) || 
				$( this ).hasClass( 'height-50' ) || 
				$( this ).hasClass( 'height-60' ) || 
				$( this ).hasClass( 'height-70' ) || 
				$( this ).hasClass( 'height-80' ) || 
				$( this ).hasClass( 'height-90' ) || 
				$( this ).hasClass( 'height-100' )
			 ) {		
			    
				var newH = $( this ).height();
				$( this ).css( {
					'height': newH + 'px'
				} );	
			 
			 }
			
			
			if( typeof dataImg != typeof undefined ) {
				$( this ).css( {
					'background': 'url(' + dataImg + ') 50% 0 no-repeat ' + dataAtt
				} );
			}
			
			if( typeof dataSkew != typeof undefined ) {
				$( this ).css( {
					'-ms-transform'     : 'skew(0deg, '+dataSkew+'deg)', /* IE 9 */
					'-webkit-transform' : 'skew(0deg, '+dataSkew+'deg)', /* Chrome, Safari, Opera */
					'transform'         : 'skew(0deg, '+dataSkew+'deg)'
				} );
			}	
			

			$( this ).bgParallax( "50%", $( this ).data( 'speed' ) );
			
		});
			
       
		
		$( '.parallax-container' ).each(function() {
			
			var dataH = $( this ).data( 'height' ),
				dataW = $( this ).data( 'width' );
			
			// If there is no data-xxx, save current source to it
			if( typeof dataH === typeof undefined ) {
				$( this ).attr( 'data-height', $( this ).css( 'height' ) );
			}
			if( typeof dataW === typeof undefined ) {
				$( this ).attr( 'data-width', $( this ).css( 'width' ) );
			}
			
			$( this ).css( {
				'height': $( this ).data( 'height' ), 
				'width': $( this ).data( 'width' ) 
			} );
			
			
		});	
		
	

    };

	

    theme.parallax = {
        documentReady : documentReady
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );


/*! 
 *************************************
 * 5. Overlay
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
    var documentReady = function( $ ) {
		
		$( '.overlay-bg' ).each(function() {
			
			var dataBgColor = $( this ).data( 'overlay-bg' ),
				dataBgOpacity = $( this ).data( 'overlay-opacity' );
			
			// If there is no data-xxx, save current source to it
			if( typeof dataBgColor != typeof undefined ) {
				if( typeof dataBgOpacity === typeof undefined ) {
					$( this ).attr( 'data-overlay-opacity', 1 );
				}
				
				$( this ).animate( { opacity: $( this ).data( 'overlay-opacity' ) }, 0 );
				
				$( this ).css( {
					'background-color': $( this ).data( 'overlay-bg' )
				} );
	
			}
			
			
			
		});		
	};
	
		
    theme.overlay = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );


/*! 
 *************************************
 * 6. Scroll Reveal
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		if ( $.browser.msie && $.browser.version < 10 ) {
			
		} else {
			
			window.sr = ScrollReveal();
			if ( sr.isSupported() ) {
				sr.reveal( ".scroll-reveal", {
					delay    : 0,
					distance : '0px',
					rotate   : { z: 0 },
					origin   : 'bottom',
					distance : '105px',
					duration : 800,
					scale    : 1
				} );
			}
		
			
			
		}

	
		
	};
	
		
    theme.scrollReveal = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );

/*! 
 *************************************
 * 7. Navigation
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var pageLoaded = function() {
		
			var $window      = $( window ),
				windowWidth  = $window.width(),
				windowHeight = $window.height();
				
		
			// Menu Hover
			$( 'ul.menu-main > li' ).unbind( 'mouseenter' ).mouseenter( function() {
				$( this ).find( ' > ul.sub-menu' ).show();
				$( this ).find( ' > ul.sub-menu ul' ).show();
			} );	
			
			$( 'ul.menu-main > li' ).unbind( 'mouseleave' ).mouseleave( function() {
				$( this ).find( ' > ul.sub-menu' ).hide();	
				$( this ).find( ' > ul.sub-menu ul' ).hide();
			} );			
				
			// Aequilate Menu
			var menuNum = $( 'ul.menu-main > li' ).length;
			aequilate();
			
			$window.resize( function() {
				aequilate();

			});
			
			function aequilate() {
				windowWidth  = $window.width();
				$( 'ul.menu-main > li' ).css( 'width',  100/menuNum + '%' );
				$( 'ul.menu-main > li ul, ul.menu-main > li a' ).css( 'min-width', (windowWidth - 48 )/menuNum + 'px' );	
				
			}
			
		
			//Add Sub-menu Arrow
			$( 'ul.menu-main li' ).find( 'ul' ).each( function() {
				$( this ).parent( 'li:first' ).prepend( '<span class="nav-arrow"></span>' );
			} );		
			
			// Mobile Menu
		    var $toggle = $( '.menu-toggle' ),
			    $menuToBody = $( '.wrapper' );
				
			$toggle.sidr({
			  name: 'sidr-left',
			  side: 'left',
			  source: '.menu-wrapper',
			  body: $menuToBody,
			  onOpen: function( ev ) {
				$toggle.addClass( 'open' );
				$menuToBody.addClass( 'blur' );  
			  },	
			  onClose: function() {
				$toggle.removeClass( 'open' );
				$menuToBody.removeClass( 'blur' );  
			  }
			  
			});
			
			
			
			$( '.sidr li' ).on( 'click', function() {
				  
				  var arrowText = $( this ).find( '.sidr-nav-arrow' ).text().replace( /(.).*\1/g, "$1" );
				  $( this ).find( '> .sidr-class-sub-menu:not(.sidr-class-sub-sub)' ).toggle();
				  
				  if ( arrowText != '-' ) {
					  $( this ).find( '.sidr-nav-arrow' ).text( '-' );
				  } else {
					  $( this ).find( '.sidr-nav-arrow' ).text( '+' );
				  }
				  
				  
			} );
			
			// Close the menu on window change
			$window.resize( function() {
				windowWidth  = $window.width();
				$.sidr( 'close', 'sidr-left' );
				$( '.menu-toggle' ).removeClass( 'open' );
				$( '.wrapper' ).removeClass( 'blur' );
				$( '.menu-wrapper' ).removeClass( 'menu-scroll-fixed' );
				if ( windowWidth <= 768 ) sidrmenu(); 
			} );
			
			if ( windowWidth <= 768 ) {
			    sidrmenu(); 
			}
		
			
			function sidrmenu() {
				
				
				$( 'a' ).attr( 'data-mobile', 1 ); //Prevent to <a> of page transitions
				
				$( '.sidr-class-menu-main > li' ).each( function() {
					if ( $( this ).find( 'ul' ).length > 0 ) {
						if ( $( this ).find( '.sidr-nav-arrow' ).length < 1 ) $( this ).prepend( '<em class="sidr-nav-arrow">+</em>' );
						$( this ).find( 'ul ul' ).addClass( 'sidr-class-sub-sub' );
						$( this ).find( ' > a' ).attr( 'href', 'javascript:void(0)' );
					}
				} );		

			}
			
			//Detect user scroll down or scroll up		
			var lastScrollTop = 0,
			    delta = 5,
				menuTop = $( '.menu-wrapper' ).offset().top;
    
			$window.resize( function() {
				menuTop = $( '.menu-wrapper' ).offset().top;
			} );
			
			$window.on('scroll', function() {
				
				if ( $window.scrollTop() >= menuTop ) {	
					$( '.menu-wrapper' ).addClass( 'menu-scroll-fixed' );
				}else{
					$( '.menu-wrapper' ).removeClass( 'menu-scroll-fixed' );
				}				

				//---
				var nowScrollTop = $(this).scrollTop();
				if ( Math.abs(lastScrollTop - nowScrollTop) >= delta ) {
					if ( nowScrollTop > lastScrollTop ) {
						// SCROLLING DOWN 
					} else {
						// SCROLLING UP 
						
					}
					lastScrollTop = nowScrollTop;
				}

				
			});	
			
			
			//Search
			$( '#menu-search-btn' ).on( 'click', function() {
				$( '.menu-left' ).css( 'width', 'calc(100% - 220px)' );
				$( '.menu-right' ).css( 'width', '219px' );
				$( 'ul.menu-main > li ul, ul.menu-main > li a' ).css( 'min-width', ($window.width() - 48 - 170 )/menuNum + 'px' );	
			
			} );
			
			$( '.menu-right' ).on( 'mouseleave', function(){
				$( '.menu-left' ).css( 'width', 'calc(100% - 60px)' );
				$( '.menu-right' ).css( 'width', '59px' );
				$( 'ul.menu-main > li ul, ul.menu-main > li a' ).css( 'min-width', ($window.width() - 48 )/menuNum + 'px' );	
			});	


			//Prevent to <a> of page transitions
			$( 'a' ).each( function() {
				var attr = $( this ).attr( 'href' );
				if ( typeof attr === typeof undefined ) {
					$( this ).attr( 'href', '#' );
				}
				
				
				if ( typeof attr !== typeof undefined && attr !== false ) {
					if  ( $( this ).attr( 'href' ).indexOf( '/#' ) >= 0   || $( this ).attr( 'href' ) == '#' ) {
						$( this ).attr( 'data-normal', 1 ); 
					 }	
				}
			});
			
		
	};
	
		
    theme.navigation = {
        pageLoaded : pageLoaded        
    };

    theme.components.pageLoaded.push( pageLoaded );
    return theme;

}( theme, jQuery, window, document ) );


/*! 
 *************************************
 * 8. Stage Effect
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		

		function dot(width, height, speed) {
			//Picks a random starting coordinate and speed within the bounds given
			this.x = Math.round(Math.random() * width);
			this.y = Math.round(Math.random() * height);
			this.speedX = Math.round(Math.random() * speed - speed / 2);
			this.speedY = Math.random(Math.random() * speed - speed / 2);
		}
		
		function dotGraph() {
			var maxDistance = 400;
			var numDots = 20;
		
			var canvas = document.getElementById("stage");
			var stage;
			var width = window.innerWidth;
			var height = window.innerHeight;
			var dots = [];
			var timer;
		
			var tick = function() {
		
				//Paints over old frame
				stage.fillStyle = "#fff";
				stage.rect(0, 0, width, height);
				stage.fill();
		
				stage.fillStyle = "#fdfdfd";
				var i = 0;
				for (i = 0; i < dots.length; i++) {
		
					//Move dot
					dots[i].x += dots[i].speedX;
					dots[i].y += dots[i].speedY;
		
					//Bounce dot off walls
					if (dots[i].x < 0) {
						dots[i].x = 0;
						dots[i].speedX *= -1;
					}
					if (dots[i].x > width) {
						dots[i].x = width;
						dots[i].speedX *= -1;
					}
					if (dots[i].y < 0) {
						dots[i].y = 0;
						dots[i].speedY *= -1;
					}
					if (dots[i].y > height) {
						dots[i].y = height;
						dots[i].speedY *= -1;
					}
		
					//Draw dot
					stage.beginPath();
					stage.arc(dots[i].x, dots[i].y, 3, 0, 2 * Math.PI);
					stage.fill();
				}
		
				//Calculate distances between every dot
				var distances = [];
				for (i = 0; i < dots.length; i++) {
					for (var j = i + 1; j < dots.length; j++) {
		
						//Add the line to the draw list if it's shorter than the specified max distance
						var dist = Math.sqrt(Math.pow(dots[i].x - dots[j].x, 2) + Math.pow(dots[i].y - dots[j].y, 2));
						if (dist <= maxDistance) distances.push([i, j, dist]);
					}
				}
		
				//Draw the lines
				for (i = 0; i < distances.length; i++) {
		
					//The farther the distance of the line, the less opaque it will be drawn
					stage.strokeStyle = "rgba(229, 229, 229, " + (maxDistance - distances[i][2]) / maxDistance + ")";
					stage.beginPath();
					stage.moveTo(dots[distances[i][0]].x, dots[distances[i][0]].y);
					stage.lineTo(dots[distances[i][1]].x, dots[distances[i][1]].y);
					stage.stroke();
				}
			};
		
			var resizeCanvas = function() {
				width = window.innerWidth;
				height = window.innerHeight;
				canvas.width = width;
				canvas.height = height;
				//console.log(width + ", " + height);
			};
		
			window.addEventListener("resize",
			function() {
				resizeCanvas();
			});
		
			//Maximize and set up canvas
			resizeCanvas();
			if (canvas.getContext) {
				stage = canvas.getContext("2d");
		
				//Create dots
				for (var i = 0; i < numDots; i++) {
					dots.push(new dot(width, height, 3));
				}
		
				//Set up timed function
				timer = setInterval(tick, 40);
			} else {
				//alert("Canvas not supported.");
			}
		}
		
		
		if ( $( '#stage' ).length > 0 ) {
			var graph = new dotGraph();
		}
		
	
	};
	
		
    theme.stageEffect = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );



/*! 
 *************************************
 * 9. FlexSlider
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var pageLoaded = function() {
		
		$( '.custom-theme-flexslider:not(.custom-primary-flexslider)' ).flexslider({
			namespace	      : 'custom-theme-flex-',
			animation         : 'slide',
			selector          : '.custom-theme-slides > div.item',
			controlNav        : true,
			smoothHeight      : true,
			prevText          : "<i class='fa fa-chevron-left'></i>",
			nextText          : "<i class='fa fa-chevron-right'></i>",
			animationSpeed    : 600,
			slideshowSpeed    : 10000,
			slideshow         : true,
			animationLoop     : true,
		    start: initslidesLightbox, //Fires when the slider loads the first slide
			before: initslidesLightbox //Fires after each slider animation completes
		});
		
	
        function initslidesLightbox( slider ) {
			slider.slides.find( "a[rel^='theme-slider-prettyPhoto']" ).prettyPhoto({
				 animation_speed:    'normal',
				 theme:              'dark_rounded',
				 slideshow:          3000,
				 utoplay_slideshow:  false
			 });
			//Prevent to <a> of page transitions
			$( 'a' ).each( function() {
				var attr = $( this ).attr( 'href' );
				
				if ( typeof attr === typeof undefined ) {
					$( this ).attr( 'href', '#' );
				}
			});	
			
        }
		
	};
	
		
    theme.flexSlider = {
        pageLoaded : pageLoaded        
    };

    theme.components.pageLoaded.push( pageLoaded );
    return theme;

}( theme, jQuery, window, document ) );


/*! 
 *************************************
 * 10. PrettyPhoto
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var pageLoaded = function() {
		
		 $( "a[rel^='theme-prettyPhoto']" ).prettyPhoto({
			 animation_speed:    'normal',
			 theme:              'dark_rounded',
			 slideshow:          3000,
			 utoplay_slideshow:  false
		 });
	 	
	};
	
		
    theme.prettyPhoto = {
        pageLoaded : pageLoaded        
    };

    theme.components.pageLoaded.push( pageLoaded );
    return theme;

}( theme, jQuery, window, document ) );

		


/*! 
 *************************************
 * 11. Page Transitions
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
			if ( $.browser.msie && $.browser.version < 10 ) {
				  $( '.animsition' ).addClass( 'bg-overlay-show' );		
			} else {
				  $( '.animsition:not(.mobile)' ).animsition({
						inClass: 'fade-in',
						outClass: 'fade-out',
						inDuration: 1500,
						outDuration: 800,
						linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([data-mobile="1"]):not([data-respond="1"]):not([data-normal="1"])',
						// e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
						loading: true,
						loadingParentElement: 'body', //animsition wrapper element
						loadingClass: 'loader',
						loadingInner: '', // e.g '<img src="loading.svg" />'
						timeout: false,
						timeoutCountdown: 5000,
						onLoadEvent: true,
						browser: [ 'animation-duration', '-webkit-animation-duration'],
						// "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
						// The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
						overlay : false,
						overlayClass : 'animsition-overlay-slide',
						overlayParentElement : 'body',
						transition: function(url){ window.location.href = url; }
				  });
			}
		
	};
	
		
    theme.pageTransitions = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );


/*! 
 *************************************
 * 12. Grid List
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
	
		$( '.portfolio-container' ).each( function() {
			var type = $( this ).data( 'show-type' );
			
			// Masonry
			if ( type.indexOf( 'masonry' ) >= 0  ) {
				$( this ).addClass( 'masonry-container' );
				$( this ).find( '.portfolio-item' ).addClass( 'masonry-item' );
			}
			
			// Filterable
			if ( type.indexOf( 'filter' ) >= 0  ) {
				$( this ).addClass( 'filter-container' );
				$( this ).find( '.portfolio-item' ).addClass( 'filter-item' );	
			}	
		
		});
	
	    /*--  Function of Masonry  --*/
		var masonryObj = $( '.masonry-container .portfolio-tiles' );
		imagesLoaded( masonryObj ).on( 'always', function() {
			  masonryObj.masonry({
				itemSelector: '.masonry-item'
			  });  
		});
		
		
	    /*--  Function of Filterable  --*/
		if ( $( "[data-show-type]" ).length > 0 ) {
			if ( $( "[data-show-type]" ).data( 'show-type' ).indexOf( 'filter' ) >= 0 ) {
				
				$( '.portfolio-container' ).each( function() {
					var filterCat = $( this ).data( 'filter-id' ),
						$grid = $( this ).find( '.portfolio-tiles' ),
						$filterOptions = $( filterCat );
						
					imagesLoaded( $grid ).on( 'always', function() {
						
						 $grid.shuffle({
							itemSelector: '.filter-item',
							speed: 550, // Transition/animation speed (milliseconds).
							easing: 'ease-out', // CSS easing function to use.
							sizer: null // Sizer element. Use an element to determine the size of columns and gutters.
						  });
						  
						
						$filterOptions.find( 'li > a' ).unbind( 'click' ).click( function(){
							
							  var $this = $( this ),
								  activeClass = 'current-cat',
								  isActive = $this.hasClass( activeClass ),
								  group = isActive ? 'all' : $this.data('group');
						
							  // Hide current label, show current label in title
							  if ( !isActive ) {
								$filterOptions.find( '.' + activeClass ).removeClass( activeClass );
							  }
						
							  $this.toggleClass( activeClass );
						
							  // Filter elements
							  $grid.shuffle( 'shuffle', group );
							  
							  return false;
							  
							  
						} ); 
					
			
					});
	
					
				} );
		
				
			} else {
				$( '[data-group="all"]' ).parent( 'li' ).hide();
			}
	
		}
		
		
		
	};
	
		
    theme.gridList = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );



/*! 
 *************************************
 * 13. Forms
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		$( '.float-label' ).each( function(){
			
			var $this = $( this );
			
			// on focus add cladd active to label
			$this.focus( function() {
				$this.next().addClass( 'active' );
			});
			//on blur check field and remove class if needed
			$this.blur( function() {
				if( $this.val() === '' || $this.val() === 'blank') {
					$this.next().removeClass();
				}
			});
			
			// if exist cookie value
			if( $this.val() != '' && $this.val() != 'blank') { 
			    $this.next().addClass( 'active' );
			}
			
		});
		
		$( '.wp-search-submit' ).click(function () {
			$( this ).parent().parent( 'form' ).submit();
		});
		
	};
	
		
    theme.forms = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );

/*! 
 *************************************
 * 14. Scroll Spy
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		var $window      = $( window ),
			windowWidth  = $window.width(),
			windowHeight = $window.height(),
			gap          = 100,
		    $share       = $( '.entry-side-share' );
		
		if ( windowWidth > 768 ) {
			
			$share.scrollToFixed( {
				marginTop  : $( '.menu-wrapper' ).outerHeight(true) + 10,
				limit: function() {
					var limit = $( '.footer-recommend-list' ).offset().top - gap;
					
					$window.on('scroll', function() {
						if ( limit <= $window.scrollTop() + gap ) {
							$share.hide();
						} else {
							$share.show();
						}
		
					});	
					
					return limit;
				}
			} );
	
		};
		
	};
	
		
    theme.scrollSpy = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );

/*! 
 *************************************
 * 15. Single Page
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		
		// Media initialization
		mediaInit();
		
		$( window ).resize( function() {
			mediaInit();

		});
		
		function mediaInit() {
			
			$( '.entry-title-nopa-container' ).each( function() {
				var media          = $( this ).find( '.entry-complex-container iframe' ),
					mediaContianer = $( this ).find( '.entry-complex-container' );
					
				if ( media.length > 0 ) {
					
					media.attr( { 'width': mediaContianer.width(), 'height': mediaContianer.height() } );
						
					var newWidth = ( $( this ).height() / media.height() ) * media.width(),
						ml       = ( $( this ).find( '.container' ).width() - newWidth ) / 2;


					mediaContianer.css( {
						'width':  newWidth + 'px',
						'margin-left':  ml + 'px'
					} );
				}
			});

		}
		
	
	};
	
		
    theme.singlePage = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );


/*! 
 *************************************
 * 16. Retina Graphics for Website
 *************************************
 */
theme = ( function ( theme, $, window, document ) {
    'use strict';
   
   
    var documentReady = function( $ ) {
		
		//Determine if you have retinal display
		var hasRetina  = false,
			rootRetina = (typeof exports === 'undefined' ? window : exports),
			mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';
	
		if ( rootRetina.devicePixelRatio > 1 || rootRetina.matchMedia && rootRetina.matchMedia( mediaQuery ).matches ) {
			hasRetina = true;
		} 

		if ( hasRetina ) {
			//do something
			$( '[data-retina]' ).each( function() {
				$( this ).attr( {
					'src'     : $( this ).data( 'retina' ),
				} );
			});
		
		} 
	
		
	};
	
		
    theme.retina = {
        documentReady : documentReady        
    };

    theme.components.documentReady.push( documentReady );
    return theme;

}( theme, jQuery, window, document ) );



