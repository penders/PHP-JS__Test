  
//    WHITE HIGHLIGHT IN NAV

  const triggers = document.querySelectorAll('a');
  const highlight = document.createElement('span');
  highlight.classList.add('highlight');
  document.body.appendChild(highlight);

function highlightLink() 
{
    const linkCoords = this.getBoundingClientRect();
    console.log(linkCoords);
    const coords = {
        width: linkCoords.width,
        height: linkCoords.height,
        top: linkCoords.top + window.scrollY,
        left: linkCoords.left + window.scrollX
    };

    highlight.style.width = `${coords.width}px`;
    highlight.style.height = `${coords.height}px`;
    highlight.style.transform = `translate(${coords.left}px, ${coords.top}px)`;

}

  triggers.forEach(a => a.addEventListener('mouseenter', highlightLink));
  
  
  //   FIXED NAVIGATION BAR
  
  
    // Not a ton of code, but hard to
    const nav = document.querySelector('#main');
    let topOfNav = nav.offsetTop;

function fixNav() 
{
    if (window.scrollY >= topOfNav) {
        document.body.style.paddingTop = nav.offsetHeight + 'px';
        document.body.classList.add('fixed-nav');
    } else {
        document.body.classList.remove('fixed-nav');
        document.body.style.paddingTop = 0;
    }
}

    window.addEventListener('scroll', fixNav);
    
    
    

    

    
    


