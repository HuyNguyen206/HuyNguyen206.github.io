import React, { Component } from 'react';
import axios from 'axios';
const insertDataToListProduct =(product_name, product_price, image)=> axios.post('/add', {product_name, product_price, image})
    .then((respond)=>respond.data)


class AddForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
            product_name: '',
            product_price:'',
            image:''
        }

    }
    changeInput = (event) => {
        const name = event.target.name
        const value = event.target.value
        this.setState({
            [name]: value
        })
    }
    pushDataToApp = () =>{
        // this.props.pushDataToAppProp(this.state)
        var {product_name, product_price, image} = this.state;
        console.log(product_name, product_price, image)
        if(product_name == '' || product_price == '' || image == '' )
        {
            alert('Vui lòng nhập đủ dữ liệu sản phẩm')
        }
        else
        {
            insertDataToListProduct(product_name, product_price, image).then((res) =>{
                // console.log(res)
                // alert(res);        
            })
            this.props.RefeshAndInsertProp(this.state);
            this.setState({
                product_name: '',
                product_price:'',
                image:''
            })
        }
       
    }
    render() {
        return (
                <div>
                <h2 className="text-center">Add new product</h2>
                    <div className="col-12">
                        <form method="" action="">
                            <div className="form-group">
                                <label htmlFor>Product Name</label>
                                <input type="text" className="form-control" name="product_name" onChange={(event) => { this.changeInput(event) }} id aria-describedby="helpId" placeholder />
                            </div>
                            <div className="form-group">
                                <label htmlFor>Product Price</label>
                                <input type="text" className="form-control" name="product_price" onChange={(event) => { this.changeInput(event) }} id aria-describedby="helpId" placeholder />
                            </div>
                            <div className="form-group">
                                <label htmlFor>Product Image Link</label>
                                <input type="text" className="form-control" name="image" onChange={(event) => { this.changeInput(event) }} id aria-describedby="helpId" placeholder />
                            </div>
                            <button type="reset" className="btn btn-primary d-block w-100" onClick={() => this.pushDataToApp()}>Add</button>
                        </form>
                    </div>
    
                    </div>

        );
    }
}

export default AddForm;