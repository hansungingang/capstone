import {combineReducers} from 'redux';
import {allUserReducer,oneUserReducer} from './reducer_users';
import { oneInquireReducer,allInquireReducer } from './reducer_inquiries';
import { allAdvertiseListReducer,oneAdvertiseLectureListReducer } from './reducer_advertise';
import { modalReducer } from './reducer_modal';

const rootReducer = combineReducers({
    allUsers : allUserReducer,
    oneUser : oneUserReducer,
    allInquiries : allInquireReducer,
    oneInquire : oneInquireReducer,
    allAdvertiseLists : allAdvertiseListReducer,
    oneAdvertiseLectureList : oneAdvertiseLectureListReducer,
    modal : modalReducer
});

export default rootReducer;