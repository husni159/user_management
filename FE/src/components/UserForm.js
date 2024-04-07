import React, { useState } from 'react';
import { useHistory } from 'react-router-dom';
import { Link } from 'react-router-dom';
import '../assets/UserForm.css'; 
import axios from 'axios';

function UserForm() {
  
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({
    email: '',
    fullName: '',
    role: ''
  });

  const history = useHistory(); 
  
  const [errors, setErrors] = useState({
    email: '',
    fullName: '',
    role: ''
  }); 

  const handleChange = (e) => {  
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  // form submit 
  const handleSubmit = async (e) => {
    e.preventDefault();
    // Set loading state to true to show the loader
    setLoading(true);
    try {
         // Validate form fields
        const newErrors = {
          email: '',
          fullName: '',
          role: ''
        }
        setErrors(newErrors);
         if (!formData.email) {
           newErrors.email = 'Email address is required';
         } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
           newErrors.email = 'Invalid email address';
         }
         
         if (!formData.fullName) {
           newErrors.fullName = 'Full name is required';
         }
         if (!formData.role) {
          newErrors.role = 'Role is required';
        }
        if (areAllValuesNull(newErrors)) {
          await addUser(formData);
        }else {
          setErrors(newErrors);
          setLoading(false);
        }
    } catch (error) {
      console.error('Error creating user:', error);
    }
  };

  function areAllValuesNull(obj) {
      for (let key in obj) {
        console.log(`obj[key] : ${obj[key]}`)
          if (obj.hasOwnProperty(key) && obj[key] !== '') {
              return false;
          }
      }
      return true;
  }

  // function to add user
  const addUser= async (formData) => {
    console.log('add user')
    await axios.post('http://127.0.0.1:8000/api/add-users', formData)
      .then(response => {
        history.push('/users');
      })
      .catch(error => {
        const newErrors = {};
        if (error.response) {
           newErrors.email    = error.response.data.errors.email??'';
           newErrors.fullName = error.response.data.errors.fullName??'';
           newErrors.role     = error.response.data.errors.role??'';
           setErrors(newErrors);
          } else {
            console.log('An unexpected error occurred.')          
          }
          setLoading(false);
    });
  }
  return (
    <div className='container'>
      <h1>User Form</h1>
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label>Full Name:</label>
          <input
            type="text"
            name="fullName"
            value={formData.fullName}
            onChange={handleChange}
          />
          {errors.fullName && <span className='error'>{errors.fullName}</span>}
        </div>
        
        <div className="form-group">
          <label>Email address:</label>
            <input
              type="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
            />
            {errors.email && <span className='error'>{errors.email}</span>}
        </div>
        <div className="form-group">
          <label>Roles:</label>
          <select value={formData.role} onChange={handleChange} 
              name="role">
            <option value="">Select Role</option>
            <option value="Author">Author</option>
            <option value="Editor">Editor</option>
            <option value="Subscriber">Subscriber</option>
            <option value="Administrator">Administrator</option>
          </select>
          {errors.role && <span className='error'>{errors.role}</span>}
        </div>
        
        <button type="submit" disabled={loading}> {loading ? 'Loading...' : 'Submit'}</button>
      </form>
      <div className="link">
        <Link to="/users">User List</Link>
      </div>      
    </div>
  );
}

export default UserForm;
