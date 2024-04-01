import React from 'react';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import UserForm from './components/UserForm';
import UserList from './components/UserList';
import './App.css';

function App() {
  return (
    <Router>
      <div className="App">
        <Switch>
          <Route exact path="/" component={UserForm} />
          <Route path="/users" component={UserList} />
        </Switch>
      </div>
    </Router>
  );
}

export default App;
