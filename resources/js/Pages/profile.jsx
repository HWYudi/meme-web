import React from "react";
import { Link } from "@inertiajs/inertia-react";
import moment from "moment";

export default function Profile({ user, auth_user }) {
    console.log(user);
    return (
        <div>
            <div className="flex gap-5 p-4">
                <div className="flex flex-col gap-2 w-28 min-w-28 max-w-28 items-center">
                    <img
                        src={`/storage/${user.image}`}
                        alt=""
                        className="w-24 h-24 object-cover rounded-full"
                    />
                    {user.id === auth_user.id ? (
                        <Link href="/account/edit">
                            <button className="px-2 w-full py-2 bg-gray-600 text-gray-200 rounded-lg hover:bg-gray-700">Edit Profile</button>
                        </Link>
                    ) : null}
                </div>
                <div>
                    <div className="flex gap-1 items-center">
                        <h1 className="font-semibold text-xl">{user.name}</h1>
                        <svg
                            width="30"
                            height="31"
                            viewBox="0 0 30 31"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20.6888 11.3976V8.71389C20.6888 5.57264 18.1413 3.02508 15.0001 3.02508C11.8588 3.01139 9.30131 5.54639 9.28756 8.68889V8.71389V11.3976"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M19.604 27.062H10.0527C7.43524 27.062 5.31274 24.9407 5.31274 22.322V16.9607C5.31274 14.342 7.43524 12.2207 10.0527 12.2207H19.604C22.2215 12.2207 24.344 14.342 24.344 16.9607V22.322C24.344 24.9407 22.2215 27.062 19.604 27.062Z"
                                fill="white"
                                stroke="white"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M14.8286 18.2533V21.0295"
                                stroke="black"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                    <p className="font-light text-xs text-white text-opacity-50">
                        @{user.username}
                    </p>
                    <div className="flex flex-row gap-3 lg:gap-10 items-center">
                        <div className="flex gap-1 items-center">
                            <p className="font-semibold text-base">
                                {user.followers.length}
                            </p>
                            <p className="font-light text-xs text-white text-opacity-50">
                                Followers
                            </p>
                        </div>
                        <div className="flex gap-1 items-center">
                            <p className="font-semibold text-lg">
                                {user.following.length}
                            </p>
                            <p className="font-light text-xs text-white text-opacity-50">
                                Following
                            </p>
                        </div>
                        <div className="flex gap-1 items-center">
                            <p className="font-semibold text-lg">
                                {user.followers.length}
                            </p>
                            <p className="font-light text-xs text-white text-opacity-50">
                                Post
                            </p>
                        </div>
                    </div>
                    <p className="break-words whitespace-normal break-all font-light text-sm text-white text-opacity-50">
                        Life Is Better When You Have
                        Friendswwwwwwwwwwwwwwwwwwwwwwwwwwwwww
                    </p>
                </div>
            </div>
            <div className="border-t border-white border-opacity-25 grid grid-cols-3 gap-5 p-4">
                {user.post.map((post) => {
                    return (
                        <div key={post.id}>
                            <Link href={`/post/${post.id}`}>
                                <img
                                    src={`/storage/${post.body}`}
                                    alt=""
                                    className="w-full h-40 lg:h-80 object-cover object-top"
                                />
                            </Link>
                        </div>
                    );
                })}
            </div>
        </div>
    );
}
