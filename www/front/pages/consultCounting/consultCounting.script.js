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
    
    static async getBranchesNames(){
    	var uri = '../../../back/API/species.php?branches=all';
    	var branches = await this.getFromAPI(uri);
    	var options = '';
		branches.forEach((branch) => {
			var name = branch.scientificTerms;
			if (branch.frenchTerms != ""
				&& branch.frenchTerms.toLowerCase() != "autres"){
				name += " (" + branch.frenchTerms + ")";
			}
		  options += '<option class="mdc-text-field__input" value="' + name + '" />';
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
