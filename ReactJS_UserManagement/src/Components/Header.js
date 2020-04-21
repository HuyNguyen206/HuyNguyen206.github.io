import React, { Component } from 'react';

class Header extends Component {
    render() {
        return (
            <header>
            <div className="container">
              <div className="row text-center pt-5">
                <div className="col-12">
                  <h1>
                    Project quản lý thành viên bằng ReactJS với dữ liệu Json
                  </h1>
                </div>
              </div>
            </div>
          </header>
        );
    }
}

export default Header;