import React, { Component } from 'react';

class PersonInfo extends Component {
    checkPermission = () => {
        var role = parseInt(this.props.role);
        if (role === 1)
            return "SuperAdmin"
        else if (role === 2)
            return "Admin"
        else return "Member"
    }
    EditUser = () => {
        this.props.getUserEditPersonProp();
    }
    render() {
        return (
            <tr>
                <td scope="row">{this.props.id}</td>
                <td>{this.props.name}</td>
                <td>{this.props.phone}</td>
                <td>
                    {
                    this.checkPermission()
                    }
                </td>
                <td>
                    <div className="action">
                        <button className="btn btn-md btn-success" onClick = {() => this.EditUser()}> Sửa</button>
                        <button className="btn btn-md btn-danger" onClick={(id) => this.props.removeUserTableProp(this.props.id)}> Xóa</button>
                    </div>
                </td>
            </tr>
        );
    }
}

export default PersonInfo;