
function NoRightClick(e) 
{ 
   if(navigator.appName=="Netscape") 
   {
      if(e.which==3||e.which==2) 
      { 
         return false; 
      }
   }
   else 
   { 
      event.cancelBubble=true; 
      event.returnValue=false;
   }
}

if(navigator.appName=="Netscape") 
   window.captureEvents(Event.MOUSEDOWN)
document.oncontextmenu=NoRightClick; 
window.onmousedown=NoRightClick;

