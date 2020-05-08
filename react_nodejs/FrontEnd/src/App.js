import React, { Component } from 'react';
import Header from './components/Header';
import Product from './components/Product';
import axios from 'axios';
import AddForm from './components/AddForm';

const getListProduct = () =>
  axios.get('/get-data')
    .then((response) => response.data)


class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listProduct: [],
    }

  }

  componentWillMount() {
    // console.log(getListProduct())
    getListProduct().then((res) => {
      this.setState({
        listProduct: res,
        isRefresh: false
      })
    })
    // this.setState({
    //   listProduct: getListProduct().then((res)=>res)
    // })


    // Make a request for a user with a given ID

  }
  RefreshAndInsertData = (data) => {
    // getListProduct().then((res) => {
    //   this.setState({
    //     listProduct: res,
    //     isRefresh: false
    //   })
    // })
    var listProduct = this.state.listProduct;
    listProduct.push(data)
    this.setState({
    listProduct: listProduct
    })
  }
  render() {

    return (
      <div>
        <Header />
        <div className="content">
          <div className="container">
            <div className="row">
              <div className="col-9">
                <div className="row row-cols-3">
                  {
                    this.state.listProduct.map((value, key) =>
                      (<Product key={key} id={value.id} name={value.product_name}
                        price={value.product_price} image={value.image} />))
                  }

                </div>
              </div>
              <div className="col-3">
                <div className="row">
                  <AddForm RefeshAndInsertProp={(data) => this.RefreshAndInsertData(data)} />
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default App;