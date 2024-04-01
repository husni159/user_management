import React, { useState } from 'react';
import { useHistory } from 'react-router-dom';
import { Link } from 'react-router-dom';
import '../assets/UserForm.css'; 
import axios from 'axios';

function UserForm() {
  const [email, setEmail] = useState('');
  const [role, setRole] = useState('');
  const [name, setFullName] = useState('');  
  const [error, setError] = useState(null);
  const history = useHistory();  
  const handleSubmit = async (e) => {
    setError(null);
    e.preventDefault();
    try {
      await axios.post('http://127.0.0.1:8000/api/add-users', { email, role, name })
      .then(response => {
        history.push('/users');
      })
      .catch(error => {
        if (error.response) {
            setError(error.response.data.message); // Assuming error response has a "message" field
          } else {
            setError('An unexpected error occurred.'); // Generic error message
          }
     });
    } catch (error) {
      console.error('Error creating user:', error);
    }
  };

  return (
    <div className='container'>
      <h1>User Form</h1>
      {error && <div className="error">{error}</div>} 
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Email address:</label>
          <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
        </div>
        <div className="form-group">
          <label>Roles:</label>
          <select value={role} onChange={(e) => setRole(e.target.value)} required>
            <option value="">Select Role</option>
            <option value="Author">Author</option>
            <option value="Editor">Editor</option>
            <option value="Subscriber">Subscriber</option>
            <option value="Administrator">Administrator</option>
          </select>
        </div>
        
        <div className="form-group">
          <label>Full Name:</label>
          <input type="text" value={name} onChange={(e) => setFullName(e.target.value)} required />
        </div>
        
        <button type="submit">Submit</button>
      </form>
      <div className="link">
        <Link to="/users">User List</Link>
      </div>      
    </div>
  );
}

export default UserForm;
