window.addEventListener('DOMContentLoaded', function (){
	window.select_product = select_product;
	var CurrentSelectedProduct = {};
	var extra_price = {};
	
	var minput = document.querySelector('#multiply');
	var btnSubmit = document.querySelector('.p-dt-submit .primary');
	var minputBox = document.querySelector('#product_submit_form .number_input');
	var txtPid = document.querySelector('#productId');
	var dtime = document.querySelector('#product_submit_form .line_time .time');
	var dprice = document.querySelector('#product_submit_form .line_total_price .price');
	var optionList = document.querySelector('#product_submit_form .options .list');
	var optionCnt = document.querySelector('#product_submit_form .options');
	var engineerLevel = document.querySelector('#product_submit_form #engineerLevel');
	var eLevelSelect = document.querySelectorAll('#levelSelect span');
	
	var option_handlers = [];
	var options_dom_list = [];
	var tpl = document.querySelector('#ProductOptionsTemplate').innerHTML.trim();

	option_handlers[1] = {
		handle: function (div, extra){
			var data = div.data;
			var input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'options[' + data.id + ']';
			div.appendChild(input);
			div.addEventListener('click', function (){
				this.classList.toggle('active');
				if(this.classList.contains('active')){
					input.value = 'on';
					extra_price[parseInt(data.id)] = div.data.price;
				} else{
					input.value = '';
					extra_price[parseInt(data.id)] = 0;
				}
				recalc();
			});

			if(extra[data.id]){
				extra_price[data.id] = extra[data.id];
				div.classList.add('active');
				input.value = 'on';
			}
		}
	};

	var last_active;
	
	document.querySelector('.number_input .left').addEventListener('click', function (){
		if(check_input() == false){
			return;
		}
		minput.value--;
		recalc();
	});
	document.querySelector('.number_input .right').addEventListener('click', function (){
		if(check_input() == false){
			return;
		}
		minput.value++;
		recalc();
	});
	window.check_input = function (){
		return !!CurrentSelectedProduct.can_submit;
	};
	
	if(window.productData){
		select_product(window.productData);
	}
	
	if(eLevelSelect.length){
		for(var i = 0; i < eLevelSelect.length; i++){
			eLevelSelect[i].addEventListener('click', function (){
				select_level(this);
			});
		}
		select_level(eLevelSelect[0]);
	}
	
	// support
	function select_product(data){
		console.log('product selected: ', data);
		CurrentSelectedProduct = data;
		CurrentSelectedProduct.period = parseInt(data.period);
		CurrentSelectedProduct.price = parseFloat(data.price).toFixed(2).replace(/\.00$/, '');
		CurrentSelectedProduct.options = data.options || {};
		
		minput.attributes['min'].value = parseInt(data.minMultiplier);
		minput.attributes['max'].value = parseInt(data.maxMultiplier);
		minput.value = parseInt(data.minMultiplier);
		minput.disabled = false;
		
		btnSubmit.classList.remove('disabled-dark');
		minputBox.classList.remove('disabled');
		data.can_submit = true;
		
		txtPid.value = data.productId;

		rebuild_options_html();
		
		recalc();
	}
	
	window.unselect_product = function (){
		btnSubmit.classList.add('disabled-dark');
		minputBox.classList.add('disabled');
		minput.disabled = true;
		dtime.innerText = '--';
		dprice.innerText = '--';
		txtPid.value = '';
		
		CurrentSelectedProduct = {};
	};
	
	function recalc(){
		var selLevel = engineerLevel.value;
		if(parseInt(minput.value) < parseInt(minput.attributes['min'].value)){
			minput.value = minput.attributes['min'].value;
		}
		if(parseInt(minput.value) > parseInt(minput.attributes['max'].value)){
			minput.value = minput.attributes['max'].value;
		}
        console.log(CurrentSelectedProduct)
		var price = CurrentSelectedProduct.displayConfig_price[selLevel];
		document.querySelector('#singlePrice').innerText = '￥' + price;
		price = price*minput.value;
		
		for(var id in extra_price){
			price += (typeof extra_price[id] == 'number'? extra_price[id] : 0);
		}
		
		dtime.innerText = '' + CurrentSelectedProduct.period*minput.value;
		dprice.innerText = '' + price;
	}

    function rebuild_options_html(){
        optionList.innerHTML = '';
        options_dom_list = [];
        var t_extra_price = extra_price;
        extra_price = {};
        var tmpDom = document.createElement('div');
        for(var i in CurrentSelectedProduct.options){
            var data = CurrentSelectedProduct.options[i];
            var line = tpl;
            for(var n in data){
                line = line.replace('{' + n + '}', data[n]);
            }
            tmpDom.innerHTML = line;
            var div = tmpDom.lastChild;
            var hs = option_handlers[data.type];
            if(hs){
                div.data = data;
                hs.handle(div, t_extra_price);
                optionList.appendChild(div);

                options_dom_list.push(div);
            }
        }
        if(options_dom_list.length == 0){
            optionCnt.classList.add('hide');
        } else{
            optionCnt.classList.remove('hide');
        }
    }
	
	function select_level(self){
		var level = self.dataset.value;
		if(last_active){
			last_active.classList.remove('active');
		}
		last_active = self;
		self.classList.add('active');
		engineerLevel.value = level;
		console.log('level selected: ', level);
		recalc();
	}
});
