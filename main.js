

		var slide_index = 0;  
		var slides = document.getElementsByClassName("slide");  
     
		
        function displaySlides(src) {  
			var i;  
			var texte ="";
			
			var src = src.split("/"); //enlever le chemin
			
			var nom = src[src.length-1];
         
            for (i = 0; i < slides.length; i++) {  
				var im = slides[i].firstElementChild;
				var ref= im.getAttribute("src"); //enlever le chemin là aussi
				ref = ref.split("/");
				ref = ref[ref.length-1];
				if ( slides[i].lastElementChild.tagName == "figcaption")
				{texte = slides[i].lastElementChild.textContent;
					
				}
				
				
		  if (nom == ref)
				{
					//afficher grandes-images/ref dans une popup avec flèches, overlay...
					slide_index = i;
			
					
					ImagePopup(nom, texte);
					break;

				}
            }  
           
		}  
		
		function ImagePopup(ref, texte) {
			
			    var overlay = document.createElement('div');
				overlay.className = 'overlay';
				var croix = document.createElement('span');
				croix.innerText ='X';
				croix.className = 'close';
				croix.addEventListener('click', function() {this.parentNode.remove();})
				overlay.appendChild(croix);
			    var popup = document.createElement('div');
			    popup.className = 'popup';
			    popupContent(ref, popup, texte);
			
			    var nextlink = document.createElement('span');
			    nextlink.className ='next';
			    nextlink.innerText = '>';
			    nextlink.addEventListener('click',goToNext);
			
			    var prevlink = document.createElement('span');
			    prevlink.className ='prev';
			    prevlink.innerText = '<';
			    prevlink.addEventListener('click',goToPrev);
			
			    overlay.appendChild(prevlink);  
			    overlay.appendChild(popup); //la popup est bien à l'intérieur de l'overlay
			   
			    overlay.appendChild(nextlink); 
			    overlay.addEventListener('click',
			        function (e) {
			            if (this == e.target) //sur l'overlay mais pas popup
			            {
			                this.remove();
			            }
			        }
			    );
			    document.body.appendChild(overlay);
			}
			
			function popupContent(ref, box, texte) {
			    
			          var img = document.createElement('img');
					  var source = document.getElementById('param').value;
			            img.src = source+ref;
						img.alt = "photo " +ref;
						img.maxWidth = "100%";
						img.marginTop = 0;
						box.appendChild(img);
						if (texte.length)
							{
								var fig = document.createElement('fig');
							var txt = document.createTextNode(texte);
							fig.appendChild(txt);
							box.appendChild(fig);
						}

			}
			

function goToNext(e) {
    e.preventDefault();
  
    var nextIndex = slide_index + 1;
    if (slides.length <= nextIndex) {
        nextIndex = 0;
    }
    goTo(nextIndex);
}

function goTo(index)
    {
		var texte ="";
var overlay = document.querySelector('.overlay');
if (overlay) {overlay.remove();}
    
	var src = slides[index].firstElementChild.getAttribute("src");
	if ( slides[index].lastElementChild.tagName == "FIGCAPTION")
	{texte = slides[index].lastElementChild.textContent;
		
	}
	ref = src.split("/");
	ref = ref[ref.length-1];
	ImagePopup(ref,texte);
        slide_index = Number(index);
}

function goToPrev(e) {
    e.preventDefault();
  
    var nextIndex = slide_index - 1;
    if (0 > nextIndex) {
        nextIndex = slides.length -1;
    }
    goTo(nextIndex);
}

function infobulle()
{
	var bulle = document.createElement('span');
	var txt = document.createTextNode('Cliquez sur une image pour avoir des détails et le diaporama');
	bulle.appendChild(txt);
	bulle.setAttribute("id","infobulle");
	document.body.appendChild(bulle);
}

function closebulle()
{
	var bulle = document.getElementsById("infobulle");
	body.removeChild(bulle);
}