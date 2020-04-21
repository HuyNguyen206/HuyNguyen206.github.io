import '../App.css';

import React, { Component } from 'react';
import Header from './Header';
import Table from './Table';
import AddUser from './AddUser';
import Search from './Search';
import ListUser from './ListUser'
import uid from 'uid';


class App extends Component {
  constructor(props, context) {
    super(props, context);
    this.state = {
      isOpen: false,
      searchText: "",
      dataUser: ListUser,
      isShowEditForm: false,
      editUserInfo: {}
    }
  }

  // function App()
  // {

  // const [isOpen, setFormStatus] = useState(false);
  // const [searchText, setSearchText] = useState("");
  // const [dataUser, setDataUser] = useState(ListUser);
  OpenForm = () => {
    // alert('Form open')
    this.setState({
      isOpen: true
    }, () => console.log(this.state.isOpen))

  }
  CloseForm = () => {
    // alert('Form Close')
    this.setState({
      isOpen: false
    }, () => console.log(this.state.isOpen))
  }

  getSearchInput = (searchText) => {
    console.log(searchText)
    this.setState({
      searchText: searchText
    });
  }

  addUser = (user) => {
    // this.state.dataUser.sort(function(a, b){return a.id - b.id});
    var person = { id: uid(4), name: user.fName, phone: user.fPhone, role: user.fRole };
    console.log(person)
    var items = this.state.dataUser;
    items.push(person);
    this.setState({
      dataUser: items
    }, () => console.log(items));
    localStorage.setItem('listUser', JSON.stringify(items))
    console.log(this.state.dataUser)
  }

  getUserEdit = (user) => {
    this.setState({
      isShowEditForm: true,
    });
    this.setState({
      editUserInfo: user
    });
    // console.log(user);

  }
  hideEditUserForm = (id, fName, fPhone, fRole) => {
    // console.log(id, fName, fPhone, fRole)
    var items = this.state.dataUser;
    var index, editUser;
    console.log(items)
    items.forEach((value, key) => {

      if (value.id === id) {
        // index = key;
        value.name = fName
        value.phone = fPhone
        value.role = fRole
      }

    })
    localStorage.setItem('listUser', JSON.stringify(items))
    // items.splice(index, 1)
    // editUser = {"id":id, "name" : fName, "phone":fPhone, "role": fRole  }
    // items.push(editUser)
    // console.log(items)
    this.setState({
      isShowEditForm: false,
      dataUser: items
    });
  }


componentWillMount() {
  if(localStorage.getItem('listUser') === null)
  {
    localStorage.setItem('listUser', JSON.stringify(ListUser))
  }
  else
  {
    this.setState({
      dataUser:JSON.parse(localStorage.getItem('listUser'))
    });
  }
}

  removeUser = (id) => {
    var items = this.state.dataUser;
    var myArray = items.filter(function (obj) {
      return obj.id !== id;
    });
    this.setState({
      dataUser: myArray
    });
    localStorage.setItem('listUser', JSON.stringify(myArray))
  }

  render() {
    // console.log('123')
    var listUserInit = [];
    if (this.state.searchText === "" || this.state.searchText === null || typeof this.state.searchText === "undefined") {
      listUserInit = this.state.dataUser

    }
    else {
      this.state.dataUser.forEach((item) => {

        if (item.name.indexOf(this.state.searchText) !== -1) {
          listUserInit.push(item);
        }
      })
    }
    // var listUserInit = []; 
    // this.state.dataUser.forEach((item)=>{
    //    if(item.name.indexOf(this.state.searchText) !== -1){
    //     listUserInit.push(item);
    //    }
    // })

    return (
      <div>

        <div>
          <Header />
          <div className="content">
            <div className="container">
              <Search editUserInfoProp={this.state.editUserInfo} hideEditUserFormPropApp={(id, fName, fPhone, fRole) => this.hideEditUserForm(id, fName, fPhone, fRole)} isShowEditFormProp={this.state.isShowEditForm} searchFunctionProp={(searchText) => this.getSearchInput(searchText)} openFormProp={() => this.OpenForm()} isFormOpenProp={this.state.isOpen} closeFormProp={() => this.CloseForm()} />
              <div className="row">
                <div className="col-12">
                  <div className="border" />
                </div>
              </div>
              <div className="row">
                <div className="col">
                  <Table removeUserProp={(id) => this.removeUser(id)} getUserEditProp={(user) => this.getUserEdit(user)} listUser={listUserInit} />
                </div>
                <AddUser addUserProp={(user) => this.addUser(user)} isFormOpenProp={this.state.isOpen} />
              </div>
            </div>
          </div>
        </div>

      </div>
    );
  }
}



export default App;

