import "./App.css";
import React, { useState, useEffect } from "react";
import Header from "./components/Header";
import AddContact from "./components/AddContact";
import ContactList from "./components/ContactList";
import ContactDetail from "./components/ContactDetail";
import EditContact from "./components/EditContact";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import api from "./api/contacts";
import { v4 as uuidv4 } from "uuid";
function App() {
  // const LOCAL_STORAGE_KEY = "contacts";
  const [contacts, setContacts] = useState([]);
  // retrieve Contacts
  const retrieveContacts = async () => {
    const response = await api.get("/contacts");
    return response.data;
  };
  const addContactHandler = async (contact) => {
    console.log(contact);
    const request = {
      id: uuidv4(),
      ...contact,
    };
    const response = await api.post("/contacts", request);
    console.log(response);
    setContacts([...contacts, response.data]);
  };
  const updateContactHandler = async (contact) => {
    const response = await api.put(`/contacts/${contact.id}`, contact);
    // eslint-disable-next-line
    const { id, name, email } = response.data;
    setContacts(
      contacts.map((contact) => {
        return contact.id === id ? { ...response.data } : contact;
      })
    );
  };
  const removeContactHandler = async (id) => {
    await api.delete(`/contacts/${id}`);
    const newcontactList = contacts.filter((contact) => {
      return contact.id !== id;
    });
    setContacts(newcontactList);
  };
  useEffect(() => {
    const getAllContacts = async () => {
      const allContacts = await retrieveContacts();
      if (allContacts) {
        setContacts(allContacts);
      }
    };
    getAllContacts();
  }, []);
  // useEffect(() => {
  //   localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(contacts));
  // }, [contacts]);
  return (
    <div className="ui container">
      <Router>
        <Header />
        <Switch>
          <Route
            path="/"
            exact
            render={(props) => (
              <ContactList
                {...props}
                contacts={contacts}
                getContactId={removeContactHandler}
              />
            )}
          />
          <Route
            path="/add"
            render={(props) => (
              <AddContact {...props} addContactHandler={addContactHandler} />
            )}
          />
          <Route
            path="/edit"
            render={(props) => (
              <EditContact
                {...props}
                updateContactHandler={updateContactHandler}
              />
            )}
          />
          <ContactList
            contacts={contacts}
            getContactId={removeContactHandler}
          />
          <Route path="/contact/:id" component={ContactDetail} />
        </Switch>
      </Router>
    </div>
  );
}

export default App;
// https://www.youtube.com/watch?v=0riHps91AzE
// https://github.com/dmalvia/React_Tutorial_Contact_Manager_App/blob/master/src/components/App.js
