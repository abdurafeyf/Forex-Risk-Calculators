<?php

include(dirname(__FILE__) . '/../settings/default.php');
include(dirname(__FILE__) . '/../settings/functions.php');

include(dirname(__FILE__) . '/../connections/api.php');

include(dirname(__FILE__) . '/../models/NotifyCounts.php');

include(dirname(__FILE__) . '/../models/Portfolio.php');

$module     = 'forex';
$page       = 'margin-calculator';
$pageTitle  = 'Forex Margin Calculator';
$pageDescription  = "A margin calculator is a tool used in forex trading to determine the amount of funds required to open and maintain a trade position. The inputs for the calculator include the currency pair being traded, the account currency, the margin ratio set by the broker, and the trade size in lots. The output is the margin requirement, which is the amount of funds that the trader must keep in their account as collateral for the trade. The margin calculator helps traders manage their risk and determine the maximum trade size that they can afford.";

include './../MasterTop.php';
include './../Header.php';

?>
<section class="container-fluid cagr">
    <meta name="description" content="A margin calculator is a tool used in forex trading to determine the amount of funds required to open and maintain a trade position.">
    <meta name="keywords" content="margin calculator, forex trading, funds, trade position, risk management, trade size, collateral, investment, exchange rate, account currency, currency pair, margin ratio, trading tool, financial tool, online margin calculator, trading calculator, margin requirement, investment management, trader, foreign exchange, financial market, money management, margin trade, trade collateral, forex investment, financial planning, margin trading, risk assessment, trade management, forex market, margin call, financial management, forex strategy, investment strategy">

    <div id="forex-overview" style="font-weight:3px">
        <object data="<?php echo $base_url; ?>/public/widgets/forex-overview" width="100%" height="110" type="text/html"> Forex Overview </object>
    </div>
    <div class="row">
        <?php
        include './../SideBarLeft.php';
        ?>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 mt-sm-minus-20 mb-3">
            <div class="cagr-calulator">
                <h1 style="font-size:24px; text-transform:uppercase">Margin Calculator <sup><span class="badge badge-danger font-11 font-weight-normal">Beta</span></sup></h1>
                <strong>Calculate Exact Margin to open your Trading Position</strong>
                <div class="calculator-form border p-3 bg-white mt-2 mb-1 shadow-sm rounded">
                    <form action="#" method="POST" id="forexRiskCalculatorForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Currency Pair</label>
                                    <select id="currency-pair" class="form-control">
                                        <option value="EURUSD">EUR/USD</option>
                                        <option value="GBPUSD">GBP/USD</option>
                                        <option value="USDJPY">USD/JPY</option>
                                        <option value="AUDUSD">AUD/USD</option>
                                        <option value="USDCHF">USD/CHF</option>
                                        <option value="USDCAD">USD/CAD</option>
                                        <option value="NZDUSD">NZD/USD</option>
                                        <option value="EURAUD">EUR/AUD</option>
                                        <option value="EURJPY">EUR/JPY</option>
                                        <option value="EURCAD">EUR/CAD</option>
                                        <option value="EURCHF">EUR/CHF</option>
                                        <option value="EURNZD">EUR/NZD</option>
                                        <option value="CADJPY">CAD/JPY</option>
                                        <option value="EURGBP">EUR/GBP</option>
                                        <option value="GBPCHF">GBP/CHF</option>
                                        <option value="CHFJPY">CHF/JPY</option>
                                        <option value="GBPJPY">GBP/JPY</option>
                                        <option value="AUDCAD">AUD/CAD</option>
                                        <option value="NZDCAD">NZD/CAD</option>
                                        <option value="USDNOK">USD/NOK</option>
                                        <option value="GBPAUD">GBP/AUD</option>
                                        <option value="GBPNZD">GBP/NZD</option>
                                        <option value="CADCHF">CAD/CHF</option>
                                        <option value="AUDNZD">AUD/NZD</option>
                                        <option value="AUDJPY">AUD/JPY</option>
                                        <option value="AUDCHF">AUD/CHF</option>
                                        <option value="GBPCAD">GBP/CAD</option>
                                        <option value="NZDCHF">NZD/CHF</option>
                                        <option value="NZDJPY">NZD/JPY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Account Currency</label>
                                    <select id="account-currency" class="form-control">
                                        <option value="USD" selected>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Margin Ratio</label>
                                    <select id="margin-ratio" class="form-control">
                                        <option value="5:1">5:1</option>
                                        <option value="10:1">10:1</option>
                                        <option value="20:1">20:1</option>
                                        <option value="25:1">25:1</option>
                                        <option value="30:1">30:1</option>
                                        <option value="33:1">33:1</option>
                                        <option value="40:1">40:1</option>
                                        <option value="50:1">50:1</option>
                                        <option value="66:1">66:1</option>
                                        <option value="100:1" selected>100:1</option>
                                        <option value="125:1">125:1</option>
                                        <option value="150:1">150:1</option>
                                        <option value="200:1">200:1</option>
                                        <option value="300:1">300:1</option>
                                        <option value="400:1">400:1</option>
                                        <option value="500:1">500:1</option>
                                        <option value="600:1">600:1</option>
                                        <option value="1000:1">1000:1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trade Size (Lots)</label>
                                    <input class="form-ctrl" type="number" value="1" id="trade-size" placeholder="Enter trade size" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0 pb-0">
                                    <button type="submit" id="calculate-button" class="btn btn-success btn-sm">Calculate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 pl-lg-3 pr-lg-4 mt-sm-minus-20 mb-3">
            <h2 style="font-size:24px; text-transform:uppercase"> &nbsp; </h2>
            <strong>&nbsp;</strong>
            <div class="calculator-result border p-3 bg-white mt-2 mb-1 rounded">
                <div class="loading text-center"><img src="<?php echo $base_url; ?>/img/loading.svg"></div>
                <div class="cagr_content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" style="font-size: 24px;" id="result">
                                    Price of EURUSD: -- <br>
                                    Margin: --
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-cagr pt-2">
                <h5 class="mt-2" style="Font-size:17px !important;">Learn more about Margin Calculator</h5>
                <p class="mt-2">A margin calculator is a tool used to determine the amount of money that a trader needs to hold as collateral in order to open a position. It is an essential tool for any trader, as it helps in managing risk and ensuring that the trader has enough funds to cover potential losses.</p>
                <h5 class="mt-2" style="Font-size:17px !important;">What is a margin calculator?</h5>
                <p class="mt-2">A margin calculator is a simple mathematical formula that takes into account the value of a trade and the amount of margin required by the broker to calculate the required margin. The formula takes into account the size of the trade, the currency pair being traded, and the leverage offered by the broker.</p>
                <h5 class="mt-2" style="Font-size:17px !important;">How to calculate margin?</h5>
                <p class="mt-2">The formula for calculating margin is as follows:
                    Margin = Trade Size / Leverage. For example, if a trader wants to trade a standard lot (100,000 units) of EUR/USD with a leverage of 1:100, the margin required would be:
                    Margin = 100,000 / 100 = 1,000. This means that the trader would need to hold 1,000 USD in their trading account to open this trade.</p>
                <h5 class="mt-2" style="Font-size:17px !important;">Importance of Margin Calculator</h5>
                <p class="mt-2">A margin calculator is important for traders because it helps in managing risk. By calculating the required margin, traders can ensure that they have enough funds in their trading account to cover potential losses. It also helps in determining the maximum number of trades that can be taken with the available capital.</p>
            </div>
        </div>
    </div>
</section>
<?php
include './../MasterFooter.php';
?>
<script>
    const currencyPairSelect = document.getElementById("currency-pair");
    const accountCurrencySelect = document.getElementById("account-currency");
    const calculateButton = document.getElementById("calculate-button");
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

    var select = document.getElementById("currency-pair");
    var options = select.options;
    var arr = [];
    for (var i = 0; i < options.length; i++) {
        arr.push(options[i]);
    }
    arr.sort(function(a, b) {
        return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
    });
    for (var i = 0; i < arr.length; i++) {
        select.appendChild(arr[i]);
    }
</script>