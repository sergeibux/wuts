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
}