document.getElementById("submit-button").addEventListener("click", function() {
    var dropdown = document.getElementById("dropdown");
    var selectedValue = dropdown.options[dropdown.selectedIndex].value;
    switch (selectedValue) {
      case "margin":
        window.location.href = "margin-calculator/margin.html";
        break;
      case "profit":
        window.location.href = "profit-calculator/profit.html";
        break;
      case "position_size":
        window.location.href = "position-size/position_size.html";
        break;
      case "pip_value":
        window.location.href = "pip-value/pip_value.html";
        break;
      default:
        // do nothing
        break;
    }
  });
  