import axios from 'axios';
let views, messages;

axios.get('/api/user/'+window.location.pathname.split("/").pop()+'/views')
.then( (response) => {
    views = response.data;
    axios.get('/api/user/'+window.location.pathname.split("/").pop()+'/messages')
    .then( (response) => {
        messages = response.data;
        generateGraph(views, messages)
    });
});

function generateGraph(arr1, arr2) {
    var ctx = document.getElementById('myChart');

    var myChart = new Chart(ctx, {
        data: {
            labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
            datasets: [
                {
                    type: 'bar',
                    label: 'N° di Visite',
                    data: arr1,
                    backgroundColor: [
                        'rgba(233, 74, 71, 0.2)'                    
                    ],
                    borderColor: [
                        'rgba(233, 74, 71, 1)',
                    ],
                    borderWidth: 1
                },
                {
                    type: 'line',
                    label: 'N° di Messaggi',
                    data: arr2,
                    /* fill: true, */
                    tension: 0.5,
                    backgroundColor: [
                        'rgba(99, 151, 208, 0.2)',                   
                    ],
                    borderColor: [
                        'rgba(99, 151, 208, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}