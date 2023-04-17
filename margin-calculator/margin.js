const currencyPairSelect = document.getElementById("currency-pair");
const accountCurrencySelect = document.getElementById("account-currency");
const calculateButton = document.getElementById("calculate-button-margin");
const tradeSizeInput = document.getElementById("trade-size");
const marginInput = document.getElementById("margin-ratio");
const result = document.getElementById("result");

// on button click
calculateButton.addEventListener("click", event => {
    // prevent the default from submission behaviour
    event.preventDefault();
    // getting value and parsing into float
    const tradeSize = parseFloat(tradeSizeInput.value);
    const margin = parseFloat((marginInput.value).slice(0, -2));
    const selectedCurrencyPair = currencyPairSelect.value;
    const selectedAccountCurrency = accountCurrencySelect.value;
    // initializing pip value
    var answer = parseFloat(0);
    var baseCurrency = selectedCurrencyPair.slice(0, 3);
    var quoteCurrency = selectedCurrencyPair.slice(3, 6);
    var marginAtHundred = parseFloat(0);

    getRate(baseCurrency, selectedAccountCurrency)
        .then((exchangeRate) => {
            marginAtHundred = tradeSize * 100 * 10 * exchangeRate;
            if (margin !== 100) {
                answer = marginAtHundred * (100 / margin);
                console.log(marginAtHundred);
            } else {
                answer = marginAtHundred;
            }
            result.style.display = "block";
            if (marginAtHundred === Infinity || marginAtHundred === 0) {
                result.innerText = `Price of ${baseCurrency}${selectedAccountCurrency}: ${exchangeRate}
        Press the Button Again`;
            } else {
                result.innerText = `Price of ${(selectedCurrencyPair)}: ${exchangeRate}
        Margin: ${answer}`;
            }
        })
        .catch((error) => {
            console.log(error);
        })

});

function getRate(currencyFrom, currencyTo) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    var urlencoded = new URLSearchParams();
    urlencoded.append("currencyFrom", currencyFrom);
    urlencoded.append("currencyTo", currencyTo);
    urlencoded.append("price", 1);

    var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
    };
    return new Promise((resolve, reject) => {
        fetch("https://sarmaaya.pk/api_prod/3.0/forex_calculator.php", requestOptions)
            .then(response => response.json())
            .then((data) => {
                resolve(data.data["conversion"]);
            })
            .catch(error => reject(error));
    });
}

for (const key in currencyPairs) {
    const option = document.createElement('option');
    option.value = key;
    option.text = currencyPairs[key];
    currencyPairSelect.appendChild(option);
}

var select = document.getElementById("currency-pair");
var options = select.options;
var arr = [];
for (var i = 0; i < options.length; i++) {
    arr.push(options[i]);
}
arr.sort(function (a, b) {
    return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
});
for (var i = 0; i < arr.length; i++) {
    select.appendChild(arr[i]);
}

