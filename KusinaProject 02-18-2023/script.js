
/// For increment and decrement buttons //////////////////

var minus = document.getElementById("dec");
var plus = document.getElementById("inc");


function increment(){
  var minus = document.getElementById("dec");
    var recipeNum = document.getElementById("recipeNum");
    recipeNum.stepUp();
    buttonStatus(plus, recipeNum);
    if(minus.disabled){
        minus.disabled = false;
    }
    
}

function decrement(){
  var plus = document.getElementById("inc");
    var recipeNum = document.getElementById("recipeNum");
    recipeNum.stepDown();
    buttonStatus(minus, recipeNum);
    if(plus.disabled){
        plus.disabled = false;
    }
}

/////////// For modal //////////

var mealPlanModal = document.getElementById("modal");
var closeButtonModal = document.getElementById("closeBtn");
window.addEventListener('click', closeModalOutside);

function openModal(){
  mealPlanModal.style.display = 'block';
}

function closeModal(){
  mealPlanModal.style.display = 'none';
}

function closeModalOutside(e){
  if(e.target == modal)
    mealPlanModal.style.display = 'none';
}


function buttonStatus(button, recipeNum){
    if(recipeNum.value == 10 || recipeNum.value == 1){
        button.disabled = true; 
    }
}






//////////////////////////////

///// for search and select button //////////////////


//hide the element that indicate the selected ingredients in the list when x-icon is clicked
// function remove(part){
//     if(part == 1){
//         document.getElementById("selected-ingredients1").style.display = "none";
//     }
//     else{
//         document.getElementById("selected-ingredients2").style.display = "none";
//     }
// }

// //Show the list of items when search button is clicked
// function listItems(part){
//     if(part == 1){
//         document.getElementById("srch1").classList.toggle("open");
//     }
//     else{
//         document.getElementById("srch2").classList.toggle("open");
//     }
// }

// //Show the element that indicate the selected ingredients in the list when the sample item is clicked
// function addIngred(part){
//     if(part == 1){
//         document.getElementById("selected-ingredients1").style.display = "inline-flex";
//     }
//     else{
//         document.getElementById("selected-ingredients2").style.display = "inline-flex";
//     }
// }

////////////////

function MultiselectDropdown(options){
    var config={
      search:true,
      height:'15rem',
      placeholder:'SEARCH',
      txtSelected:'selected',
      txtAll:'All',
      txtRemove: 'Remove',
      txtSearch:'SEARCH',
      ...options
    };
    function newEl(tag,attrs){
      var e=document.createElement(tag);
      if(attrs!==undefined) Object.keys(attrs).forEach(k=>{
        if(k==='class') { Array.isArray(attrs[k]) ? attrs[k].forEach(o=>o!==''?e.classList.add(o):0) : (attrs[k]!==''?e.classList.add(attrs[k]):0)}
        else if(k==='style'){  
          Object.keys(attrs[k]).forEach(ks=>{
            e.style[ks]=attrs[k][ks];
          });
         }
        else if(k==='text'){attrs[k]===''?e.innerHTML='&nbsp;':e.innerText=attrs[k]}
        else e[k]=attrs[k];
      });
      return e;
    }
  
    
    document.querySelectorAll("select[multiple]").forEach((el,k)=>{
      
      var div = newEl('div',{class:'multiselect-dropdown'});
      var div2 = newEl('div',{class:'selectedContainer'});
  
      el.parentNode.insertBefore(div,el.nextSibling);
      el.parentNode.insertBefore(div2,div.nextSibling);
      var listWrap=newEl('div',{class:'multiselect-dropdown-list-wrapper'});
      var list=newEl('div',{class:'multiselect-dropdown-list',style:{height:config.height}});
      var search=newEl('input',{class:['multiselect-dropdown-search'].concat([config.searchInput?.class??'form-control']),type:'text',style:{display:el.attributes['multiselect-search']?.value==='true'?'block':'none'},placeholder:config.txtSearch});
      listWrap.appendChild(search);
      div.appendChild(listWrap);
      listWrap.appendChild(list);
  
      el.loadOptions=()=>{
        list.innerHTML='';
        
        /* if you want to add the select all button */
        // if(el.attributes['multiselect-select-all']?.value=='true'){
        //   var op=newEl('div',{class:'multiselect-dropdown-all-selector'})
        //   var ic=newEl('input',{type:'checkbox'});
        //   op.appendChild(ic);
        //   op.appendChild(newEl('label',{text:config.txtAll}));
    
        //   op.addEventListener('click',()=>{
        //     op.classList.toggle('checked'); //add class
        //     op.querySelector("input").checked=!op.querySelector("input").checked; //reverse the checkbox value when clicked
            
        //     var ch=op.querySelector("input").checked;
        //     list.querySelectorAll(":scope > div:not(.multiselect-dropdown-all-selector)")
        //       .forEach(i=>{if(i.style.display!=='none'){i.querySelector("input").checked=ch; i.optEl.selected=ch}}); /*checked/select all div when all*/
    
        //     el.dispatchEvent(new Event('change')); /*idk*/
        //   });
        //   ic.addEventListener('click',(ev)=>{
        //     ic.checked=!ic.checked; /*check the when clicked in checkbox*///--its should be automatic but idk why its not working when removed
        //   });
    
        //   list.appendChild(op); //append the 'all' div to 'list' div
        // }
  
        Array.from(el.options).map(o=>{   //almost same with previously but function for each item
          var op = newEl('div',{class:o.selected?'checked':'',optEl:o})
          var ic = newEl('input',{class:'checkbox', type:'checkbox',checked:o.selected});
          var lb = newEl('label',{text:o.text});
          var sp = newEl('span', {class:'customize-checkbox'});
          op.appendChild(ic);
          op.appendChild(sp);
          op.appendChild(lb);
  
          op.addEventListener('click',()=>{
            op.classList.toggle('checked');
            op.querySelector("input").checked=!op.querySelector("input").checked;
            op.optEl.selected=!!!op.optEl.selected;    //select the item in select element (for database purposes)
            el.dispatchEvent(new Event('change'));  //idk what the use of this, just manually dispatching a 'change' event but there's no functionality
          });
          ic.addEventListener('click',(ev)=>{  //again check when the checkbox is clicked
            ic.checked=!ic.checked;
          });
          o.listitemEl=op;     //wtf is this
          list.appendChild(op);
        });
        div.listEl=listWrap; //to point listEl property of div to listwrap object
        div.appendChild(newEl('span',{class:'placeholder',text:el.attributes['placeholder']?.value??config.placeholder}));
  
        div2.refresh=()=>{
          div2.querySelectorAll('div.selected-ingredients').forEach(t=>div2.removeChild(t)); //remove existing selections
          var sels=Array.from(el.selectedOptions);  //take the selected options from select tag
         
          
            sels.map(x=>{  //output the selected list
              var c = newEl('div',{class:'selected-ingredients'});
              var txt = newEl('span',{class:'optext',text:x.text, srcOption: x});
              if((el.attributes['multiselect-hide-x']?.value !== 'true')){
                var i = newEl('i',{class:['fa-sharp' , 'fa-solid', 'fa-xmark']});
                var s = newEl('span',{class:'optdel',text:'',title:config.txtRemove, onclick:(ev)=>{txt.srcOption.listitemEl.dispatchEvent(new Event('click'));div2.refresh(); ev.stopPropagation()}}); //remove the selected item when clicked
                s.appendChild(i);
              }

              //append the text and span containg the icon
              c.appendChild(txt); 
              c.appendChild(s)

              div2.appendChild(c); //append the container into the div
            });
           //if
        };
        div2.refresh();
      }
      el.loadOptions();
      
      search.addEventListener('input',()=>{ //for searching of items
        list.querySelectorAll(":scope div:not(.multiselect-dropdown-all-selector)").forEach(d=>{
          var txt=d.querySelector("label").innerText.toUpperCase();
          d.style.display=txt.includes(search.value.toUpperCase())?'block':'none';
        });
      });
  
      div.addEventListener('click',()=>{
        listWrap.style.visibility='visible'; 
        listWrap.style.opacity= '1'; //show the list
      });
      
      document.addEventListener('click', function(event) {
        if (!div.contains(event.target)) {
          listWrap.style.visibility='hidden'; 
          listWrap.style.opacity= '0'; //hide the list
          div2.refresh();
        }
      });    
    });
  }
  
  window.addEventListener('load',()=>{
    MultiselectDropdown(window.MultiselectDropdownOptions);
  });
