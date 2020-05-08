import React, { Component } from 'react';

class Product extends Component {
  render() {
    return (
      <div className="col mb-4">
        <div className="card h-100">
          <img src={this.props.image} className="card-img-top" alt="..." />
          <div className="card-body">
            <h5 className="card-title">{this.props.name}</h5>
            <p className="card-text">{this.props.price}</p>
          </div>
        </div>
      </div>
    );
  }
}

export default Product;