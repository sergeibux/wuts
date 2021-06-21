// Navigation vers les autres pages
document.getElementById('index').onclick = () => {
    location.href = '../../index.html';
}

const handleChange = (event) => {
    setValue(event.target.value);
};
