import React,{ useEffect,useState } from 'react'
import { Link, useParams } from 'react-router-dom'
import { fetchOneAdvertiseLectureListAsync } from '../../reducers/reducer_advertise';
import { useSelector,useDispatch } from 'react-redux';
import { DataGrid } from '@material-ui/data-grid';
import DeleteOutline from '@material-ui/icons/DeleteOutline';
import Modal from '../../components/modal/Modal';
import { fetchAllLectureListAsync } from '../../reducers/reducer_modal';
import { deleteLectureToAdvertiseAsync } from '../../reducers/reducer_advertise';

export default function AdvertiseLecture() {
    const lectureList = useSelector(state => state.oneAdvertiseLectureList)
    const dispatch = useDispatch();
    const {advertiseId} = useParams();

    useEffect(() => {
        // Update the document title using the browser API
        (async () => {
            dispatch(fetchOneAdvertiseLectureListAsync(advertiseId));
        })()
    },[]);

    const showModal = () => {
        dispatch(fetchAllLectureListAsync());
    }

    const deleteLecture = (id) => {
        (async () => {
            dispatch(deleteLectureToAdvertiseAsync(id));
        })()
    }

    const columns = [
        { field: 'id', headerName: 'ID', width: 110 },
        { field: 'lecture', headerName: '제목,강사이름', width: 200 , renderCell: (params) => {
            return(
                <div>
                      {params.value[0].name},
                      {params.value[0].instructor_name}
                </div>
                 )
        }},
        {
            field:"action",
            headerName:"Action",
            width:160,
            renderCell: (params) => {
                return(
                    <>
                    <DeleteOutline className='productListDelete' onClick={() => deleteLecture(params.row.id)}/>
                    </>
                )
            }
        },
    ];
  return (
    <div className='productList'>
        <Modal advertiseId={advertiseId}/>
        <div className='addAdvertise'>
            <button className="addAdvertiseButton" onClick={()=>{showModal();}}>
                  강의 추가
            </button>
        </div>
        <DataGrid
            disableSelectionOnClick
            rows={lectureList}
            columns={columns}
            pageSize={8}
            checkboxSelection
            disableSelectionOnClick
         />
    </div>
  )
}
