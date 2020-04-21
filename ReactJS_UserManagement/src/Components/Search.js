import React, { Component } from 'react';
import EditUser from './EditUser';

class Search extends Component {
    constructor(props, context) {
        super(props, context);
        this.state = {
            searchText: ""
        }
    }
    

    isChangeSearch = (event) => {
        const name = event.target.name;
        const value = event.target.value;
         this.setState({
             [name] : value
         },(searchText) => this.props.searchFunctionProp(this.state.searchText))
    }
    displayButton = () => {
            if (this.props.isFormOpenProp) {
                return (<div className="btn btn-block btn-outline-warning" onClick={() => { this.props.closeFormProp() }} >Close User form</div>)
            }
            else {
                return (<div className="btn btn-block btn-outline-info" onClick={() => { this.props.openFormProp() }}>Open User form</div>)
            }
    }
    dispayEditUserForm = () => {
        if(this.props.isShowEditFormProp){
            return(
                <EditUser editUserInfoFormProp = {this.props.editUserInfoProp} hideEditUserFormProp = {(id, fName, fPhone, fRole) => this.props.hideEditUserFormPropApp(id, fName, fPhone, fRole)}/>
            )
        }
        else{
            return true
        }
    }
    render() {
        return (
            <div className="row">
               {
                   this.dispayEditUserForm()
               }
                <div className="col-lg-4 col-md-6 search">
                    <div>
                        <div className="form-group">
                            <input name="searchText"  type="text" className="form-control" aria-describedby="helpId" onChange={(event) => this.isChangeSearch(event)}/>
                            <button className="btn btn-md btn-primary" onClick = {(searchText) => this.props.searchFunctionProp(this.state.searchText)}><i className="fa fa-search" aria-hidden="true"  /></button>
                        </div>
                        {
                            this.displayButton()
                        }



                    </div>
                </div>
            </div>
        );
    }
}

export default Search;