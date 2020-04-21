import React, { Component } from 'react';
import PersonInfo from './PersonInfo';

class Table extends Component {


    render() {
        console.log(this.props.listUser);
        return (
            <table className="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th style={{ width: '200px' }}>Tên</th>
                        <th>Điện thoại</th>
                        <th>Quyền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>

                    {
                        (
                            () => {
                                if (typeof this.props.listUser !== 'undefined' && this.props.listUser.length > 0) {
                                    return (this.props.listUser.map((value, key) => {
                                        return <PersonInfo removeUserTableProp = {(id) => this.props.removeUserProp(id)} getUserEditPersonProp = {() => this.props.getUserEditProp(value)} key={key} id={value.id} name={value.name} phone={value.phone} role={value.role} />
                                    })
                                    )

                                }
                                else return (<tr>
                                    <td colSpan="5" className="text-center">
                                        No data
                                        </td>
                                </tr>)

                            }
                        )()

                    }
                </tbody>
            </table>
        );
    }
}

export default Table;