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
    
    static async displaySpecies(){
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
    
    static async getSpeciesNames(){
    	var uri = '../../../back/API/species.php?species=all';
    	var species = await this.getFromAPI(uri);
    	var options = '';
		species.forEach((specie) => {
			var name = specie.scientificName;
			if (specie.frenchName != ""
				&& specie.frenchName.toUpperCase() != "AUTRES"){
				name += " (" + specie.frenchName + ")";
			}
			  options += '<option class="mdc-text-field__input" data-value="' + specie.id + '">' + name + '</option>';
		})

		document.getElementById('species').innerHTML = options;
    }
    
    static async getBranchesNames(){
    	var uri = '../../../back/API/species.php?branches=all';
    	var branches = await this.getFromAPI(uri);
    	var options = '';
		branches.forEach((branch) => {
			var name = branch.scientificTerms;
			if (branch.frenchTerms != ""
				&& branch.frenchTerms.toUpperCase() != "AUTRES"){
				name += " (" + branch.frenchTerms + ")";
			}
		  options += '<option class="mdc-text-field__input" data-value="' + branch.id + '">' + name + '</option>';
		})

		document.getElementById('branch').innerHTML = options;
    }

    
    static async getFromAPI(uri){
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

ConsultCounting.getBranchesNames();
ConsultCounting.getSpeciesNames();