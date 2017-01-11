function getname(elem){
  var suppr = elem.name;
  var hidd = document.getElementById("hid");
  hidd.setAttribute('value',suppr);
  hidd.checked = true;
}
