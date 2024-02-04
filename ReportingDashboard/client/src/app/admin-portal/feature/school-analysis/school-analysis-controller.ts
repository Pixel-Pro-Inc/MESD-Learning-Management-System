const express = require('express');
const app = express();

app.use(express.json());

app.post('/path/to/your/endpoint', (req, res) => {
    const grades = req.body.grades;
    // Process the grades data...
});

app.listen(3000, () => console.log('Server is listening on port 3000'));