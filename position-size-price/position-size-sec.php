<?php

include(dirname(__FILE__) . '/../settings/default.php');
include(dirname(__FILE__) . '/../settings/functions.php');

include(dirname(__FILE__) . '/../connections/api.php'); 
 
include(dirname(__FILE__) . '/../models/NotifyCounts.php');

include(dirname(__FILE__) . '/../models/Portfolio.php'); 

$module     = 'forex';
$page       = 'position-size-sec';
$pageTitle  = 'Position Size Calculator 2.0';
$pageDescription  = 'A position size calculator is a tool used in trading to determine the appropriate number of shares or contracts to buy or sell in a given trade. Its an important tool for risk management and is widely used by traders.';

include './../MasterTop.php';
include './../Header.php';

?>  
<section class="container-fluid cagr">
<meta name="description" content="Position size calculator is a simple tool that helps traders determine the appropriate trade size for their account balance and risk management strategy.">
<meta name="keywords" content="forex, trading, risk management, position sizing, stop loss, take profit, leverage, margin, risk-reward ratio, calculator, position size calculator, position sizing calculator, forexfactory, metatrader 4, eurusd, ftmo, mt4, metatrader 5, babypips, lot size calculator, forex calculator, position size calculator, position sizing, risk management, trading calculator, trade management, forex calculator, stock calculator, position size formula, position size strategy, position size calculator forex, position size calculator stocks, position size calculator options, position size calculator crypto, position size calculator excel, position size calculator mt4, position size calculator app, position size calculator online, position size calculator tool, position size calculator software, position size calculator free, position size calculator download, position size calculator spreadsheet, position size calculator mt5, position size calculator indicator, position size calculator script, position size calculator api, position size calculator excel template, position size calculator stock market, position size calculator options trading, position size calculator cryptocurrency, position size calculator tradingview, position size calculator mt4 indicator, position size calculator for stocks, position size calculator for options, position size calculator for forex, position size calculator for crypto, position size calculator for mt4, position size calculator for mt5, position size calculator for tradingview, position size calculator for excel, position size calculator for spreadsheet, position size calculator for app, position size calculator for software, position size calculator for online tool, position size calculator for free download, position size calculator for indicator, position size calculator for script, position size calculator for api, position size calculator for excel template, position size calculator for stock market, position size calculator for options trading, position size calculator for cryptocurrency, position size calculator in forex, position size calculator in stocks, position size calculator in options, position size calculator in crypto, position size calculator in excel, position size calculator in mt4, position size calculator in app, position size calculator in online tool, position size calculator in free download, position size calculator in indicator, position size calculator in script, position size calculator in api, position size calculator in excel template, position size calculator in stock market, position size calculator in options trading, position size calculator in cryptocurrency">

<div id="forex-overview" style="font-weight:3px">
    <object data="<?php echo $base_url; ?>/public/widgets/forex-overview" width="100%" height="110"  type="text/html"> Forex Overview </object> 
</div>
    <div class="row">
        <?php
        include './../SideBarLeft.php'; 
        ?>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 mt-sm-minus-20 mb-3">
            <div class="cagr-calulator">
                <h1 style="font-size:24px; text-transform:uppercase">Position Size Calculator 2.0 <sup><span class="badge badge-danger font-11 font-weight-normal">Beta</span></sup></h1>
                <strong>Calculate Position Sizing</strong>
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
                                    <label>Account Size(Equity)</label>
                                    <input class="form-ctrl" type="number" value="1000" id="account-size" placeholder="Enter account size" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Risk Percentage</label>
                                    <input class="form-ctrl" type="number" value="2" id="risk-percentage" placeholder="Enter risk percentage" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Entry Price</label>
                                    <input class="form-ctrl" type="number" value="1.0881" id="entry-price" placeholder="Enter entry price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>StopLoss Price</label>
                                    <input class="form-ctrl" type="number" value="1.0886" id="stop-price" placeholder="Enter stoploss price" required>
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
                                    Amount at Risk: 20 USD<br>Sizing: 0.0200 Lots
                                </div> 
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="about-cagr pt-2">
                <h5 class="mt-2" style="Font-size:17px !important;">Learn more about Position Size Calculator</h5>
                <p class="mt-2">A position size calculator for forex is a tool that helps traders determine the appropriate number of units to trade in a currency pair, based on the size of their account and the level of risk they are willing to take. The calculator takes into account the trader's account balance, the size of the stop loss and the desired level of risk, and then calculates the number of units that should be traded.</p>
                <p class="mt-2">The key benefit of using a position size calculator is that it helps traders maintain proper risk management. When trading forex, it is important to keep the risk on each trade within a specific percentage of the account balance. This is known as risk management. Without proper risk management, a trader can easily blow through their account balance with just a few losing trades.</p>
                <p class="mt-2">The position size calculator helps traders determine the appropriate number of units to trade based on the size of their account and the level of risk they are willing to take. It works by taking into account the trader's account balance, the size of the stop loss and the desired level of risk, and then calculates the number of units that should be traded.</p>
                <p class="mt-2">For example, if a trader has a $10,000 account balance and wants to risk no more than 2% of the account on each trade, the calculator would calculate that the trader should not trade more than 200 units in the currency pair.</p>
                <p class="mt-2">In addition, the position size calculator is also useful to determine the value per pip. A pip is a unit of measurement for currency movement, and is the fourth decimal place in most currency pairs. Knowing the value per pip is important for setting stop loss and take profit levels, and for determining the potential profit or loss from a trade.</p>
                <p class="mt-2">The position size calculator is a useful tool for forex traders who want to limit their risk and make informed trading decisions. It assists traders in determining the optimum amount of units to trade in a currency pair based on their account size and risk tolerance. As a result, it is an extremely beneficial tool for traders looking to optimize their transactions and maximise their earnings.</p>
            </div>
        </div>
    </div>
</section>
<?php
include './../MasterFooter.php';  
?> 
<script>
    const accountSizeInput = document.getElementById("account-size");
    const riskPercentageInput = document.getElementById("risk-percentage");
    const currencyPairSelect = document.getElementById("currency-pair");
    const accountCurrencySelect = document.getElementById("account-currency");
    const entryPriceInput = document.getElementById("entry-price");
    const stopPriceInput = document.getElementById("stop-price");
    const calculateButton = document.getElementById("calculate-button");
    const result = document.getElementById("result");

    // on button click
    calculateButton.addEventListener("click", event => {
      // prevent the default from submission behaviour
      event.preventDefault();
      // getting value and parsing into float
      const accountSize = parseFloat(accountSizeInput.value);
      const riskPercentage = parseFloat(riskPercentageInput.value);
      // const tradeSize = parseFloat(tradeSizeInput.value);
      const tradeSize = parseFloat(1);
      const selectedCurrencyPair = currencyPairSelect.value;
      const selectedAccountCurrency = accountCurrencySelect.value;
      const entryPrice = parseFloat(entryPriceInput.value);
      const stopPrice = parseFloat(stopPriceInput.value);
      // initializing pip value
      var pip_value = 0;
      var baseCurrency = selectedCurrencyPair.slice(0, 3);
      var quoteCurrency = selectedCurrencyPair.slice(3, 6);
      var if_jpy = (quoteCurrency === "JPY") ? 100:1;
      var val_jpy = (quoteCurrency === "JPY") ? 1000:10;
      var random = parseFloat(0);
      var stopLoss = parseFloat(0);
      if (quoteCurrency == "JPY" || baseCurrency == "JPY") {
        stopLoss = Math.abs(entryPrice-stopPrice) * 100000;
        console.log(stopLoss);
      }
      else {
        stopLoss = Math.abs(entryPrice-stopPrice) * 100000;
      }

      getRate("USD", quoteCurrency)
      .then((data)=>{
        random = data;
      })
      .catch((error)=>{
        console.log(error);
      })
      getRate(baseCurrency, quoteCurrency)
      .then((exchangeRate) => {
          if (quoteCurrency === "USD") {
            pip_value = 10;
          }
          else if (baseCurrency === "USD") {
            pip_value = 10/exchangeRate;
          }
          else {
            pip_value = 10/random;
          }
          let standardLots = (accountSize * (riskPercentage/100)) / (stopLoss * pip_value);
          result.style.display = "block";
          if (pip_value === Infinity) {
            result.innerText = `Amount at Risk: ${accountSize*(riskPercentage/100)} ${selectedAccountCurrency} 
            Press the button again`;  
          }
          else {
            result.innerText = `Amount at Risk: ${accountSize*(riskPercentage/100)} ${selectedAccountCurrency} 
            Sizing: ${(standardLots/if_jpy * val_jpy).toFixed(2)} Lots`;
          }
      })
      .catch((error)=> {
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
              .then((data)=>{
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