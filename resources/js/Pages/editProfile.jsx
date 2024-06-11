import { Inertia  } from "@inertiajs/inertia";
import React from "react";
import { useState } from "react";
export default function editProfile({ user }) {

  const [Image , setImage] = useState(null);
  const [Username , setUsername] = useState(null);
  const [Bio , setBio] = useState(null);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const formData = {
      image: Image,
      username: Username !== null ? Username : user.username,
      bio: Bio !== null ? Bio : user.bio
    }
    Inertia.post(`/account/edit/${user.id}`, formData)
  }
  console.log(user);
    return (
        <div>
            <form onSubmit={handleSubmit} encType="multipart/form-data" className="flex gap-5 lg:gap-5 px-2 py-4 lg:p-8">
                <div className="w-1/3 lg:w-fit flex flex-col items-center">
                    <label htmlFor="upload-photo" className="relative">
                        <img
                             src={Image ? URL.createObjectURL(Image) : `/storage/${user.image}`}
                            alt=""
                            className="w-24 h-24 object-cover rounded-full"
                        />
                        <svg
                            className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                            width="56"
                            height="56"
                            viewBox="0 0 56 56"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <rect
                                width="56"
                                height="56"
                                rx="28"
                                fill="#0F0F0F"
                                fill-opacity="0.5"
                            />
                            <path
                                d="M36.2726 15V24.4545"
                                stroke="#CBCBCB"
                                stroke-width="4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M40.9998 19.7273H31.5453"
                                stroke="#CBCBCB"
                                stroke-width="4"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M25.6364 16.1818C23.5774 19.5883 21.2309 20.7791 15 21.4999V40.409H41V25.9318"
                                stroke="#CBCBCB"
                                stroke-width="4"
                                stroke-linecap="round"
                            />
                            <path
                                d="M28 33.9091C30.6108 33.9091 32.7273 31.7926 32.7273 29.1818C32.7273 26.571 30.6108 24.4545 28 24.4545C25.3892 24.4545 23.2727 26.571 23.2727 29.1818C23.2727 31.7926 25.3892 33.9091 28 33.9091Z"
                                stroke="#CBCBCB"
                                stroke-width="4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </label>
                    <input type="file" id="upload-photo" name="image" onChange={(e) => setImage(e.target.files[0])} />
                    <h1 className="pt-4 font-semibold">Profile Picture</h1>
                    <p className="text-xs text-white text-opacity-50">
                        PNG or JPG Up To 5MB
                    </p>
                </div>
                <div className="w-full lg:w-1/2 border-l border-white pl-5">
                    <div className="py-2">
                        <label htmlFor="name" className="text-sm font-semibold">
                            Username
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="username"
                            placeholder={user.username}
                            onChange={(e) => setUsername(e.target.value)}
                            className="block w-full px-3 py-1 mt-1 text-sm border border-gray-300 rounded-md bg-transparent focus:outline-none focus:border-blue-500"
                        />
                    </div>
                    <div className="py-2">
                        <label htmlFor="bio" className="text-sm font-semibold">
                            Bio
                        </label>
                        <textarea
                id="bio"
                name="bio"
                autoComplete="off"
                placeholder={user.bio ? user.bio : "No Bio Yet ."}
                value={Bio}
                onChange={(e) => setBio(e.target.value)}
                className="no-resize break-all block w-full px-3 py-1 mt-1 text-sm border border-gray-300 rounded-md bg-transparent focus:outline-none focus:border-blue-500"
                rows="4" // Anda bisa menyesuaikan jumlah baris sesuai kebutuhan
                style={{resize: "none"}}
            />
                    </div>

                    <div className="py-2">
                        <button type="submit" className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded w-full">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    );
}
