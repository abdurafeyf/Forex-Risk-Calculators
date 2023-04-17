const accountSizeInputPips = document.getElementById("account-sizePips");
const riskPercentageInputPips = document.getElementById("risk-percentagePips");
const stopLossInputPips = document.getElementById("stop-lossPips");
const currencyPairSelectPips = document.getElementById("currency-pairPips");
const accountCurrencySelectPips = document.getElementById("account-currencyPips");
const calculateButtonPips = document.getElementById("calculate-buttonPips");
// const tradeSizeInput = document.getElementById("trade-size");
const resultPips = document.getElementById("resultPips");

// on button click
calculateButtonPips.addEventListener("click", event => {
    // prevent the default from submission behaviour
    event.preventDefault();
    // getting value and parsing into float
    const accountSize = parseFloat(accountSizeInputPips.value);
    const riskPercentage = parseFloat(riskPercentageInputPips.value);
    const stopLoss = parseFloat(stopLossInputPips.value);
    // const tradeSize = parseFloat(tradeSizeInput.value);
    const tradeSize = parseFloat(1);
    const selectedCurrencyPair = currencyPairSelectPips.value;
    const selectedAccountCurrency = accountCurrencySelectPips.value;
    // initializing pip value
    var pip_value = 0;
    var baseCurrency = selectedCurrencyPair.slice(0, 3);
    var quoteCurrency = selectedCurrencyPair.slice(3, 6);
    var pipSize = (quoteCurrency === "JPY") ? 0.01 : 0.0001;
    var if_jpy = (quoteCurrency === "JPY") ? 100 : 1;
    var random = parseFloat(0)

    getRate("USD", quoteCurrency)
        .then((data) => {
            random = data;
        })
        .catch((error) => {
            console.log(error);
        })
    getRate(baseCurrency, quoteCurrency)
        .then((exchangeRate) => {
            if (quoteCurrency === "USD") {
                pip_value = 10;
            } else if (baseCurrency === "USD") {
                pip_value = 10 / exchangeRate;
            } else {
                pip_value = 10 / random;
            }
            let standardLots = (accountSize * (riskPercentage / 100)) / (stopLoss * pip_value);
            resultPips.style.display = "block";
            if (pip_value === Infinity) {
                resultPips.innerText = `Amount at Risk: ${accountSize * (riskPercentage / 100)} ${selectedAccountCurrency} 
                Press the button again`;
            }
            else {
                resultPips.innerText = `Amount at Risk: ${accountSize * (riskPercentage / 100)} ${selectedAccountCurrency} 
        Sizing: ${(standardLots / if_jpy).toFixed(4)} Lots`;
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
    currencyPairSelectPips.appendChild(option);
}

var selectPips = document.getElementById("currency-pairPips");
var optionsPips = selectPips.options;
var arrPips = [];
for (var i = 0; i < optionsPips.length; i++) {
    arrPips.push(optionsPips[i]);
}
arrPips.sort(function (a, b) {
    return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
});
for (var i = 0; i < arrPips.length; i++) {
    selectPips.appendChild(arrPips[i]);
}