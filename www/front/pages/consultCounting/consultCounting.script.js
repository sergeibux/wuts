// Navigation vers les autres pages
document.getElementById('index').onclick = () => {
    location.href = '../../index.html';
}

class ConsultCounting {
    constructor(prop, handler, el) {
        this.prop = prop;
        this.handler = handler;
        this.el = el;
    }

    bind() {
        let bindingHandler = Binder.handler[this.handler];
        bindingHandler.bind(this);
        Binder.subscribe(this.prop, () => {
            bindingHandler.react(this);
        });
    }

    setValue(value) {
        Binder.scope[this.prop] = value;
    }
    getValue() {
        return Binder.scope[this.prop];
    }
    
    async displaySpecies(){
    	var str = document.getElementById('speciesInput').value;
    	var uri = '../../../back/API/species.php?species=match&search=' + str + '&limit=20';
    	var species = await this.getFromAPI(uri);
    	var options = '';
    	document.getElementById('speciesSection').innerHTML = "";
		species.forEach((specie) => {
			var name = specie.scientificName;
			if (specie.frenchName != ""
				&& specie.frenchName.toUpperCase() != "AUTRES"){
				name += " (" + specie.frenchTerms + ")";
			}
			var img = document.createElement('img');
			img.className = "thumb";
			img.src = "../../asset/images/" + specie.picture;
			document.getElementById('speciesSection').appendChild(img);
		})
    }
    
    async getSpeciesNames(){
    	var uri = '../../../back/API/species.php?species=all';
    	var species = await this.getFromAPI(uri);
    	var options = '';
		species.forEach((specie) => {
			var name = specie.scientificName;
			if (specie.frenchName != ""
				&& specie.frenchName.toUpperCase() != "AUTRES"){
				name += " (" + specie.frenchName + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + specie.id + '" name ="' + name + '">' + name + '</option>';
		})

		document.getElementById('species').innerHTML = options;
    }
    
    async getGendersNames(){
    	var uri = '../../../back/API/species.php?genders=all';
    	var genders = await this.getFromAPI(uri);
    	var options = '';
    	genders.forEach((gender) => {
			var name = gender.scientificTerms;
			if (gender.frenchTerms != ""
				&& gender.frenchTerms.toUpperCase() != "AUTRES"){
				name += " (" + gender.frenchTerms + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + gender.id + '" name ="' + name + '">' + name + '</option>';
		})

		document.getElementById('genders').innerHTML = options;
    }
    
    async getFamiliesNames(){
    	var uri = '../../../back/API/species.php?families=all';
    	var families = await this.getFromAPI(uri);
    	var options = '';
    	families.forEach((family) => {
			var name = family.scientificTerms;
			if (family.frenchTerms != ""
				&& family.frenchTerms.toUpperCase() != "AUTRES"){
				name += " (" + family.frenchTerms + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + family.id + '" name ="' + name + '">' + name + '</option>';
		})

		document.getElementById('families').innerHTML = options;
    }
    
    async getOrdersNames(){
    	var uri = '../../../back/API/species.php?orders=all';
    	var orders = await this.getFromAPI(uri);
    	var options = '';
    	orders.forEach((order) => {
			var name = order.scientificTerms;
			if (order.frenchTerms != ""
				&& order.frenchTerms.toUpperCase() != "AUTRES"){
				name += " (" + order.frenchTerms + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + order.id + '" name ="' + name + '">' + name + '</option>';
		})

		document.getElementById('orders').innerHTML = options;
    }
    
    async getClassesNames(){
    	var uri = '../../../back/API/species.php?classes=all';
    	var classes = await this.getFromAPI(uri);
    	var options = '';
    	classes.forEach((classe) => {
			var name = classe.scientificTerms;
			if (classe.frenchTerms != ""
				&& classe.frenchTerms.toUpperCase() != "AUTRES"){
				name += " (" + classe.frenchTerms + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + classe.id + '" name ="' + name + '">' + name + '</option>';
		})

		document.getElementById('classes').innerHTML = options;
    }
    
    async getPossibleClassesNames(){
    	this.getPossibleNames(branch, branchesInput, "branches", "classes");
    }

    async getPossibleOrdersNames(){
    	this.getPossibleNames(classes, classesInput, "classes", "orders");
    }
    
    async getPossibleFamiliesNames(){
    	this.getPossibleNames(orders, ordersInput, "orders", "families");
    }
    
    async getPossibleGendersNames(){
    	this.getPossibleNames(families, familiesInput, "families", "genders");
    }
    
    async getPossibleSpeciesNames(){
    	this.getPossibleNames(genders, genderInput, "genders", "species");
    }
    
    async getPossibleNames(datalistId, inputId, strSuperCat, strCat){
    	var selectedOption = datalistId.options.namedItem(inputId.value);
		if (selectedOption) {
			var selectedId = selectedOption.getAttribute('data-value');
		    var result = "data-values : " + selectedId;
		    console.log({selectedId});
		} else {
		    var result = "No genders ID available for value : " + inputId.value;
		}
		var byId = strSuperCat[0].toUpperCase() + strSuperCat.substring(1)
		byId = "by" + byId + "Id";
    	var uri = '../../../back/API/species.php?' + strCat + '=' + byId + '&search=' + selectedId + '&limit=500';
    	var results = await this.getFromAPI(uri);
    	var options = '';
    	results.forEach((result) => {
			var name = result.scientificName != null ? result.scientificName : result.scientificTerms;
			var frenchName = result.frenchName != null ? result.frenchName : result.frenchTerms; 
			if (frenchName != ""
				&& frenchName.toUpperCase() != "AUTRES"){
				name += " (" + frenchName + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + result.id + '" name ="' + name + '">' + name + '</option>';
		})

		document.getElementById(strCat).innerHTML = options;
    }

    async getBranchesNames(){
    	var uri = '../../../back/API/species.php?branches=all';
    	var branches = await this.getFromAPI(uri);
    	var options = '';
    	branches.forEach((branch) => {
    		var name = branch.scientificTerms;
    		if (branch.frenchTerms != ""
    			&& branch.frenchTerms.toUpperCase() != "AUTRES"){
    			name += " (" + branch.frenchTerms + ")";
    		}
    		options += '<option class="mdc-text-field__input" data-value="' + branch.id + '" name ="' + name + '">' + name + '</option>';
    	})
    	
    	document.getElementById('branch').innerHTML = options;
    }
    
    
    async getFromAPI(uri){
    	return new Promise(function (resolve, reject) {
	    	var request = new XMLHttpRequest()
	
	    	request.open('GET', uri, true)
	
	    	request.onload = function () {
	    		if (this.status >= 200 && this.status < 300) {
		  		  	resolve(JSON.parse(this.response));
	    		} else {
	    			reject({
	                    status: this.status,
	                    statusText: xhr.statusText
	                });
	    		}
	    	}
	    	request.send()
    	});
    }
    
}

var consultCounting = new ConsultCounting();
consultCounting.getBranchesNames();
consultCounting.getClassesNames();
consultCounting.getOrdersNames();
consultCounting.getFamiliesNames();
consultCounting.getGendersNames();
consultCounting.getSpeciesNames();