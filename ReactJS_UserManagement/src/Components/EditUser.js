import React, { Component } from 'react';

class EditUser extends Component {
  constructor(props) {
    super(props);
    this.state = {
      currentRoleId: 0,
      fName:this.props.editUserInfoFormProp.name,
      fPhone:this.props.editUserInfoFormProp.phone,
      fRole:this.props.editUserInfoFormProp.role,
      id:this.props.editUserInfoFormProp.id
      
    }
    
  }
  

  // checkRenderPermission = (propParamRole) => {
  //   var listRole = [{"id":1, "role" : "SuperAdmin"}, {"id":2, "role" : "Admin"},{"id":3, "role" : "Member"}]
  //   listRole.map((value, key )=>{
  //     // console.log(propParamRole)
  //     // console.log(value.id)
  //     if(propParamRole === value.id )
  //     {
  //       // alert(123)
  //       console.log(123)
  //     return(
  //     <option key = {key} selected defaultValue={value.id}>{value.role} </option>
  //     )
  //     }
  //     else {
  //       // alert(456)
  //       console.log(456)
  //     return(
  //     <option key = {key}  defaultValue={value.id}>{value.role} </option>
  //     )
  //   }
  //   })
  // }
 changeInput = (event) =>{
   const name = event.target.name;
   const value = event.target.value;
   this.setState(
     {
     [name]:value,
     }
   );
 }
  render() {
    console.log("abc");
    console.log(this.props.editUserInfoFormProp);
    
    return (
      <div className="col-12">
        <div className="add-user bg-warning">
          <h5>Sửa thông tin user</h5>
          <form method="get">
            <div className="form-group">
              <input type="text" className="form-control block" onChange ={(event)=>this.changeInput(event)} name="fName" aria-describedby="helpId" placeholder="Tên" defaultValue={this.props.editUserInfoFormProp.name} />
            </div>
            <div className="form-group">
              <input type="text" className="form-control block" onChange ={(event)=>this.changeInput(event)} name="fPhone" aria-describedby="helpId" placeholder="Điện thoại" defaultValue={this.props.editUserInfoFormProp.phone} />
            </div>
            <div className="form-group">
              <select className="form-control block" onChange ={(event)=>this.changeInput(event)} name="fRole" defaultValue = {this.props.editUserInfoFormProp.role} >
                <option value={0} disabled>--Select Role--</option>
                <option value={1}>SuperAdmin </option>
                <option value={2}>Admin </option>
                <option value={3}>Member</option>
                {/* {this.checkRenderPermission(this.props.editUserInfoFormProp.role)} */}
              </select>
            </div>
            <button type="reset" className="btn btn-primary mt-2 btn-block" onClick={(id, fName, fPhone, fRole) => this.props.hideEditUserFormProp(this.state.id, this.state.fName, this.state.fPhone, this.state.fRole)}>Save</button>
          </form>
        </div>
      </div>
    );
  }
}

export default EditUser;