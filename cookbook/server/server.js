const mongoose = require('mongoose');

const app = require('./app');
const keys = require('./config/keys');
const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
  mongoose.connect(keys.DB_URL, {
    useNewUrlParser: 'true',
    useUnifiedTopology: 'true',
    useCreateIndex: 'true',
    useFindAndModify: 'false'
  }).then(() => {
    console.log('Database connected');
  }).catch((err) => {
    console.log(err)
  });
  console.log(`App listening on port ${PORT}`);
});
