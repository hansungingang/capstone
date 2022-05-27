import React from 'react';
import { useDispatch,useSelector } from 'react-redux';
import { hideModal } from '../../reducers/reducer_modal';
import { DataGrid } from '@material-ui/data-grid';
import { storeLectureToAdvertiseAsync } from '../../reducers/reducer_advertise';

export default function Modal({advertiseId}) {
    const dispatch = useDispatch();
    const modal = useSelector(state => state.modal)
    
    if(modal.length < 1){
        return null;
    }

    const onCloseButtonClick = () => {
        dispatch(hideModal());
    }

    const onAddButtonClick = (lectureId) => {
        dispatch(storeLectureToAdvertiseAsync(advertiseId,lectureId));
    }

    const columns = [
        { field: 'id', headerName: 'ID', width: 110 },
        { field: 'name', headerName: 'LectureName', width: 200},
        { field: 'instructor_name', headerName: 'InstructorName', width: 200},
        {
            field:"action",
            headerName:"Action",
            width:160,
            renderCell: (params) => {
                return(
                    <>
                        <button className="productListEdit" onClick={() => {onAddButtonClick(params.row.id)}}>Add</button>
                    </>
                )
            }
        },
    ];
    return (
        <div className="modal-overlay">
            <div className="modal">
                <span className="modal-close" onClick={onCloseButtonClick}>
                &#10005; {/* HTML code for a multiplication sign */}
                </span>
                <DataGrid
                    disableSelectionOnClick
                    rows={modal}
                    columns={columns}
                    pageSize={10}
                    checkboxSelection
                />
            </div>
        </div>
    )
}
