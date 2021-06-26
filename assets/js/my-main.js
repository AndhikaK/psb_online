// function PrintDiv() {
//   var divToPrint = document.getElementById("divToPrint");
//   var popupWin = window.open("", "_blank", "width=900,height=900");
//   popupWin.document.open();
//   popupWin.document.write(
//     '<html><body onload="window.print()">' + divToPrint.innerHTML + "</html>"
//   );
//   popupWin.document.close();
// }

function PrintDiv(id) {
  let pageToPrint = window.open("print.php?id=" + id);
  pageToPrint.print();
  pageToPrint.close();
}
