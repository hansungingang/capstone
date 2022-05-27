import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Sidebar from '../components/sidebar/Sidebar.jsx';
import Topbar from '../components/topbar/Topbar.jsx';
import Home from '../pages/home/Home.jsx';
import {
    BrowserRouter as Router,
    Routes,
    Route
  } from "react-router-dom";
import UserList from '../pages/userList/UserList.jsx';
import User from '../pages/user/User.jsx';
import AdvertiseList from '../pages/advertiseList/AdvertiseList.jsx';
import AdvertiseLecture from '../pages/advertiseLecture/AdvertiseLecture.jsx';
import { Provider } from 'react-redux';
import rootReducer from '../reducers/root.js';
import { createStore,applyMiddleware } from 'redux';
import ReduxThunk from 'redux-thunk';
import Inquire from '../pages/inquire/Inquire.jsx';
import InquireList from '../pages/inquireList/InquireList.jsx';

const createStoreWithMiddleware = applyMiddleware(ReduxThunk)(createStore);


class Index extends Component {
    render(){
        return (
            <Provider store={createStoreWithMiddleware(rootReducer)}> 
                <Router>
                    <Topbar/>
                    <div className="container">
                        <Sidebar/>
                        <Routes>
                            <Route exact path="/admin" element={<Home/>}/>
                            <Route path="/admin/users" element={<UserList/>}/>
                            <Route path="/admin/user/:userId" element={<User/>}/>
                            <Route path="/admin/advertiseLists" element={<AdvertiseList/>}/>
                            <Route path="/admin/advertise/:advertiseId" element={<AdvertiseLecture/>}/>
                            <Route path="/admin/inquiries" element={<InquireList/>}/>
                            <Route path="/admin/inquire/:inquireId" element={<Inquire/>}/>
                        </Routes>
                    </div>
                </Router>
            </Provider>
        );
    }
}

export default Index;

if (document.getElementById('root')) {
    ReactDOM.render(<Index />, document.getElementById('root'));
}

