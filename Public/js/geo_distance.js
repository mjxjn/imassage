function calculate_distances(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function (position){
			on_recive_location(position.coords);
		});
	}
}

function on_recive_location(position){
	console.log('get current location: {%s, %s}', position.latitude, position.longitude);
	var eles = document.querySelectorAll('[data-lat][data-lng]');
	var sorter = [];
	for(var i = 0; i < eles.length; i++){
		var item = eles[i];
		var source = {
			latitude : parseFloat(item.dataset.lat),
			longitude: parseFloat(item.dataset.lng)
		};
		if(source.latitude && source.longitude){
			var dist = geolib.getDistance(source, position);
			if(dist >= 1000){
				item.innerHTML = (dist/1000).toFixed(2) + '公里';
			} else{
				item.innerHTML = Math.round(dist) + '米';
			}
			console.log('calc dist : {%s, %s} -> %s', source.latitude, source.longitude, item.innerHTML);
			item = parent_until(item, 'LI');
			if(item){
				sorter.push({
					dist: dist,
					li  : item
				});
			}
		}
	}

	var parent = document.querySelector('#Main');
	sorter.sort(function (a, b){
		return a.dist - b.dist;
	}).forEach(function (item){
		parent.appendChild(item.li);
	});

	document.body.classList.add('geo-loaded');
	document.body.classList.remove('no-location');
}
function parent_until(self, target){
	while(self && self.nodeName != target){
		self = self.parentNode;
	}
	return self;
}
function no_location_available(){
	console.log('no geo-location from server...');
	document.body.classList.add('no-location');
	if(navigator.geolocation){
		console.log('ask permission...');
		navigator.geolocation.getCurrentPosition(function (position){
			console.log('permission granted...');
			on_recive_location({
				latitude : position.coords.latitude,
				longitude: position.coords.longitude
			});
		}, function (){
			console.log('permission denied...');
			document.body.classList.add('no-location');
		});
	}
}
