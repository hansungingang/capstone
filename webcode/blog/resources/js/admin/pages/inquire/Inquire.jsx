import React,{ useEffect,useState } from 'react';
import PermIdentityIcon from '@material-ui/icons/PermIdentity';
import CalendarTodayIcon from '@material-ui/icons/CalendarToday';
import MailOutlineIcon from '@material-ui/icons/MailOutline';
import { fetchOneInquireAsync,fetchOneInquireUpdateAsync } from '../../reducers/reducer_inquiries';
import { useSelector,useDispatch } from 'react-redux';
import { useParams } from 'react-router-dom';

function Inquire() {
    const oneInquire = useSelector(state => state.oneInquire);
    const dispatch = useDispatch();
    const {inquireId} = useParams();

    const [answer,setAnswer] = useState(oneInquire.answer);

    const handleAnswerChange = event =>{
        setAnswer(event.target.value);
    }

    const handleSubmit = (event) => {
        event.preventDefault();
        const data = {answer : answer};
        (async () => {
            dispatch(fetchOneInquireUpdateAsync(inquireId,data));
        })()
    }

    useEffect(() => {
        // Update the document title using the browser API
        (async () => {
            dispatch(fetchOneInquireAsync(inquireId));
        })()
    },[]);

  return (
        <div className='inquire'>
            <div className="inquireTitleContainer">
                <h1 className='inquireTitle'>Edit Inquire</h1>
            </div>
            <div className="inquireContainer">
                <div className="inquireShow">
                    <div className="inquireShowTop">
                        <div className="inquireShowTopTitle">
                            <span className="inquireShowUsername">{oneInquire.email}</span>
                        </div>
                    </div>
                    <div className="inquireShowBottom">
                        <span className="inquireShowTitle">Inquire Details</span>
                        <div className="inquireShowInfo">
                            <PermIdentityIcon className="inquireShowIcon"/>
                            제목 : <span className="inquireShowInfoTitle">{oneInquire.title}</span>
                        </div>
                        <div className="inquireShowInfo">
                            <CalendarTodayIcon className="inquireShowIcon"/>
                             내용 : <span className="inquireShowInfoTitle">{oneInquire.content}</span>
                        </div>
                        <div className="inquireShowInfo">
                            <CalendarTodayIcon className="inquireShowIcon"/>
                            답변 : <span className="inquireShowInfoTitle">{oneInquire.answer}</span>
                        </div>
                        <span className="inquireShowTitle">Contact Details</span>
                        <div className="inquireShowInfo">
                            <MailOutlineIcon className="inquireShowIcon"/>
                            <span className="inquireShowInfoTitle">{oneInquire.email}</span>
                        </div>
                    </div>
                </div>
                <div className="inquireUpdate">
                    <span className="inquireUpdateTitle">Edit</span>
                    <form className="inquireUpdateForm" onSubmit={handleSubmit}>
                        <div className="inquireUpdateLeft">
                            <div className="inquireUpdateItem">
                                <label>Answer</label>
                                <input type="text" id="name" placeholder={oneInquire.answer || ""} className="inquireUpdateInput" onChange={handleAnswerChange} defaultValue={answer || ""}/>
                            </div>
                        </div>
                        <div className="inquireUpdateRight">
                            <button type="submit" className="inquireUpdateButton">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  )
}

export default Inquire;