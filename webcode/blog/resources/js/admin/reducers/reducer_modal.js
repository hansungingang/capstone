import { fetchToken } from "./AuthService";
const SHOW_MODAL = 'SHOW_MODAL';
const HIDE_MODAL = 'HIDE_MODAL';

const getAllLecturesUrl = '/api/lecture/get/all';

export function fetchAllLectureListAsync(){
    return (dispatch) => {
        fetchToken()
        .then((response)=>{
            const config = {
                headers: { Authorization: `Bearer ${response.data.token}` }
            }
            axios.get(getAllLecturesUrl,config)
            .then((response)=>{
                dispatch(showModal(response.data.data))
            })
        })
        .catch((error)=>{
            return null;
        })
    }
}

function showModal(data){
    return {
        type : SHOW_MODAL,
        payload : data
    }
}

export function hideModal(){
    return {
        type:HIDE_MODAL
    }
}

const initialModalState = [];

export function modalReducer(state = initialModalState, action){
    switch(action.type){
        case SHOW_MODAL:
            return action.payload;
        case HIDE_MODAL:
            return [];
        default:
            return state;
    }
}