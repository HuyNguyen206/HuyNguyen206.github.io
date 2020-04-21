import React, { Component } from 'react';

class AddUser extends Component {
  constructor(props, context) {
    super(props, context);
    this.state = {
      // isOpen: false,
      fName:"",
      fPhone:"",
      fRole:""
    }
  }
  // SwitchForm = (isOpenValue) => {
  //   this.setState({
  //     isOpen: isOpenValue
  //   })
  //   console.log(this.state.isOpen)
  // }
  // OpenForm = () => {
  //   this.setState({
  //     isOpen: true
  //   }, () => console.log(this.state.isOpen))

  // }
  // CloseForm = () => {
  //   this.setState({
  //     isOpen: false
  //   }, () => console.log(this.state.isOpen))
  // }

 isChangeInput = (event) => {
   const name = event.target.name;
   const value = event.target.value;
   this.setState({
     [name] : value
   });
 }

  // renderForm = () => (
  //   <div className="col">
  //   <div className="add-user">
  //     <h5>Thêm mới User</h5>
  //     <form method="get">
  //       <div className="form-group">
  //         <input type="text" className="form-control" name="fName" onChange = {(event) => this.isChangeInput(event)} aria-describedby="helpId" placeholder="Tên" />
  //       </div>
  //       <div className="form-group">
  //         <input type="text" className="form-control" name="fPhone" onChange = {(event) => this.isChangeInput(event)} aria-describedby="helpId" placeholder="Điện thoại" />
  //       </div>
  //       <div className="form-group">
  //         <select defaultValue="0" className="form-control" name="fRole" onChange = {(event) => this.isChangeInput(event)}>
  //           <option value='0' disabled>--Select Role--</option>
  //           <option value='1'>SuperAdmin </option>
  //           <option value='2'>Admin </option>
  //           <option value='3'>Member</option>
  //         </select>
  //       </div>
  //       <button type="submit" className="btn btn-primary mt-2 btn-block" onClick = {() => this.props.addUserProp(this.state)}>Add User</button>
  //     </form>
  //   </div>
  //   </div>

  // )

  checkRenderForm = () => {
    if (this.props.isFormOpenProp) {
      return  (
        <div className="col">
        <div className="add-user">
          <h5>Thêm mới User</h5>
          <form method="get">
            <div className="form-group">
              <input type="text" className="form-control" name="fName" onChange = {(event) => this.isChangeInput(event)} aria-describedby="helpId" placeholder="Tên" />
            </div>
            <div className="form-group">
              <input type="text" className="form-control" name="fPhone" onChange = {(event) => this.isChangeInput(event)} aria-describedby="helpId" placeholder="Điện thoại" />
            </div>
            <div className="form-group">
              <select defaultValue="0" className="form-control" name="fRole" onChange = {(event) => this.isChangeInput(event)}>
                <option value={0} disabled>--Select Role--</option>
                <option value={1}>SuperAdmin </option>
                <option value={2}>Admin </option>
                <option value={3}>Member</option>
              </select>
            </div>
            <button type="reset" className="btn btn-primary mt-2 btn-block" onClick = {(user) => this.props.addUserProp(this.state)}>Add User</button>
          </form>
        </div>
        </div>
      )
    }
  }
  

  // renderForm= () => (
  //   <div className="row">
  //   <div className="col-12">
  //   <div className="form-group">
  //   <label htmlFor />
  //   <input type="text" ref={this.setTextInputRef} defaultValue={this.props.titleArticle} className="form-control" name="name" id aria-describedby="helpId" placeholder />
  //   <small id="helpId" className="form-text text-muted">Help text</small>
  //   <div className="btn btn-info btn-sm"  onClick={() => this.hideForm()}>
  //       Save
  //   </div>
  // </div>
  // </div>
  // </div>

  // )

  render() {
    // alert(this.props.isFormOpenProp);
    console.log(this.props.isFormOpenProp)
    return (

<div>
{
this.checkRenderForm()
}
</div>

      
    );
  }
}

export default AddUser;