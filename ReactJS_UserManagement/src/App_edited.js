import './App.css';

import React, { useState } from 'react';
import Header from './Components/Header';
import Table from './Components/Table';
import AddUser from './Components/AddUser';
import Search from './Components/Search';
import ListUser from './Components/ListUser'




  function App()
  {

  const [isOpen, setFormStatus] = useState(false);
  const [searchText, setSearchText] = useState("");
  const [dataUser, setDataUser] = useState(ListUser);

  function OpenForm() {
    setFormStatus(true)
  }
  function CloseForm() {
    setFormStatus(false)
  }

  function getSearchInput(searchText){
    setSearchText(searchText)
  }

  function addUser(user) {
    dataUser.sort(function(a, b){return a.id - b.id});
    const person = {name:user.fName, phone:user.fPhone, role:user.fRole, id:dataUser[dataUser.length - 1].id + 1};
    var items =  dataUser;
    items.push(person);
    setDataUser(items)
    console.log(dataUser);
  }
    var listUser = [];
    // console.log(searchText)
    if (searchText === "" ||searchText === null || typeof searchText === "undefined" )
    {
     
      listUser = dataUser
   
    }
    else
    {
      dataUser.forEach((item) => {
     
        if(item.name.indexOf(searchText) !== -1)
        {
          listUser.push(item);
        }
      })
    }
    
  // console.log(listUser)
  // console.log(123)
  // function log()
  // {
    // console.log(123);
    // alert(1)
  // }
  // log()
    return (
      // <div></div>
      <div>

        <div>
        <Header/>
          <div className="content">
            <div className="container">
            <Search searchFunctionProp = {(searchText) => getSearchInput(searchText)} openFormProp={() => OpenForm()}  isFormOpenProp = {isOpen} closeFormProp = {() => CloseForm()} />
              <div className="row">
                <div className="col-12">
                  <div className="border" />
                </div>
              </div>
              <div className="row">
                <div className="col">
                <Table listUser={listUser} />
                </div>       
                <AddUser addUserProp = {(user) => addUser(user)} isFormOpenProp = {isOpen} />
              </div>
            </div>
          </div>
        </div>
       
      </div>
    );
  }



export default App;

