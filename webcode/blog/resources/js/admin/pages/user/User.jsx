import React, { useEffect,useState } from 'react'
import PermIdentityIcon from '@material-ui/icons/PermIdentity';
import CalendarTodayIcon from '@material-ui/icons/CalendarToday';
import MailOutlineIcon from '@material-ui/icons/MailOutline';
import { useParams } from 'react-router-dom';
import { useSelector,useDispatch } from 'react-redux';
import { fetchOneUserAsync,fetchOneUserUpdateAsync } from '../../reducers/reducer_users';

function User(){
    const oneUser = useSelector(state => state.oneUser)
    const dispatch = useDispatch();
    const {userId} = useParams();

    const [email,setEmail] = useState(oneUser.email);
    const [name,setName] = useState(oneUser.name);
    const [type,setType] = useState(oneUser.type);

    const handleEmailChange = event =>{
        setEmail(event.target.value);
    }
    const handleNameChange = event =>{
        setName(event.target.value);
    }
    const handleTypeChange = event =>{
        setType(event.target.value);
    }

    useEffect(() => {
        // Update the document title using the browser API
        (async () => {
            dispatch(fetchOneUserAsync(userId));
        })()
    },[]);

    const handleSubmit = (event) => {
        event.preventDefault();
        const data = {email : email, name : name, type: type};
        (async () => {
            dispatch(fetchOneUserUpdateAsync(userId,data));
        })()
    }

    return (
        <div className='user'>
            <div className="userTitleContainer">
                <h1 className='userTitle'>Edit User</h1>
            </div>
            <div className="userContainer">
                <div className="userShow">
                    <div className="userShowTop">
                        <div className="userShowTopTitle">
                            <span className="userShowUsername">{oneUser.name}</span>
                            <span className="userShowUserTitle">회원</span>
                        </div>
                    </div>
                    <div className="userShowBottom">
                        <span className="userShowTitle">Account Details</span>
                        <div className="userShowInfo">
                            <PermIdentityIcon className="userShowIcon"/>
                            <span className="userShowInfoTitle">{oneUser.name}</span>
                        </div>
                        <div className="userShowInfo">
                            <CalendarTodayIcon className="userShowIcon"/>
                            <span className="userShowInfoTitle">{oneUser.type}</span>
                        </div>
                        <span className="userShowTitle">Contact Details</span>
                        <div className="userShowInfo">
                            <MailOutlineIcon className="userShowIcon"/>
                            <span className="userShowInfoTitle">{oneUser.email}</span>
                        </div>
                    </div>
                </div>
                <div className="userUpdate">
                    <span className="userUpdateTitle">Edit</span>
                    <form className="userUpdateForm" onSubmit={handleSubmit}>
                        <div className="userUpdateLeft">
                            <div className="userUpdateItem">
                                <label>name</label>
                                <input  type="text" id="name" placeholder={oneUser.name || ""} className="userUpdateInput" onChange={handleNameChange} defaultValue={name || ""}/>
                            </div>
                            <div className="userUpdateItem">
                                <label>Email</label>
                                <input  type="text" id="email" placeholder={oneUser.email || ""} className="userUpdateInput" onChange={handleEmailChange}  defaultValue={email || ""}/>
                            </div>
                            <div className="userUpdateItem">
                                <label>Type</label>
                                <input  type="text" id="type" placeholder='admin|user' className="userUpdateInput" onChange={handleTypeChange}  defaultValue={type || ""}/>
                            </div>
                        </div>
                        <div className="userUpdateRight">
                            <button type="submit" className="userUpdateButton">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
  
}

export default User;