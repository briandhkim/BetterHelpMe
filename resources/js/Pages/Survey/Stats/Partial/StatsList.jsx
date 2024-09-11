const StatsList = ({ answers }) => {
	return (
		<ul role='list' className='space-y-3'>
			{Object.keys(answers).map(question => (
				<li
					key={question}
					className='overflow-hidden rounded-md bg-white px-6 py-4 shadow'
				>
					<h3 className='text-lg mb-4'>
						<small className='text-sm mr-2'>Q.</small>
						<span className='font-bold'>{question}</span>
					</h3>

					<div>
						<p>
							The following answers each received{' '}
							{answers[question][0].count} inputs.
						</p>
					</div>

					<dl className='divide-y divide-gray-100'>
						{answers[question].map((answer, idx) => (
							<div
								key={answer['input']}
								className={`${idx % 2 ? 'bg-white' : 'bg-gray-200'} px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-3`}
							>
								<dd className='mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0'>
									{answer['input']}
								</dd>
							</div>
						))}
					</dl>
				</li>
			))}
		</ul>
	);
};

export default StatsList;
